<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\Http\Requests\ProfileFormRequest;
use App\Http\Requests;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('administrator.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Yajra\CMS\Http\Requests\ProfileFormRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    public function update(ProfileFormRequest $request)
    {
        $profile = $request->user();
        $profile->fill($request->only(['first_name', 'last_name', 'username', 'email']));

        if ($request->get('password')) {
            $profile->password = bcrypt($request->get('password'));
        }

        if ((null !== $request->file('avatar')) && $request->file('avatar')->isValid()) {
            $fileType = $request->file('avatar')->getClientOriginalExtension();
            $filename = auth()->user()->id . '-' . $request->file('avatar')->getFilename() . '.' . $fileType;
            $request->file('avatar')->move('media/avatar', $filename);
            $profile->avatar = url('media/avatar/' . $filename);
        }

        $profile->save();

        flash()->success(trans('cms::profile.alert.success'));

        return redirect()->route('administrator.profile.edit');
    }

    /**
     * @param \Yajra\CMS\Http\Requests\ProfileFormRequest $request
     * @return string
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    protected function getFilename(ProfileFormRequest $request)
    {
        $fileName = $request->user()->id . '.' . $request->file('avatar')->getClientOriginalExtension();

        return $fileName;
    }

    /**
     * Remove current user's avatar.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAvatar()
    {
        $profile         = auth()->user();
        $profile->avatar = '';
        $profile->save();

        return redirect()->route('administrator.profile.edit');
    }
}
