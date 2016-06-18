<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Requests;
use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;
use Yajra\CMS\Entities\Category;
use Yajra\CMS\Entities\Menu;
use Yajra\Datatables\Datatables;

class UtilitiesController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Console\Kernel
     */
    protected $command;

    /**
     * @var \Collective\Html\HtmlBuilder
     */
    protected $html;

    /**
     * @var \Illuminate\Contracts\Logging\Log
     */
    protected $log;

    /**
     * Controller specific permission ability map.
     *
     * @var array
     */
    protected $customPermissionMap = [
        'backup' => 'view',
        'config' => 'view',
        'cache'  => 'view',
        'logs'   => 'view',
        'views'  => 'view',
        'index'  => 'view',
    ];

    /**
     * UtilitiesController constructor.
     *
     * @param \Illuminate\Contracts\Console\Kernel $command
     * @param \Illuminate\Contracts\Logging\Log $log
     * @param \Collective\Html\HtmlBuilder $html
     */
    public function __construct(Kernel $command, Log $log, HtmlBuilder $html)
    {
        $this->command = $command;
        $this->html    = $html;
        $this->log     = $log;

        $this->authorizePermissionResource('utilities');
    }

    /**
     * Display list of utilities.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        return view('administrator.utilities.index');
    }

    /**
     * Execute back up manually.
     *
     * @param string $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function backup($task = 'run')
    {
        if (! in_array($task, ['backup', 'clean'])) {
            $message = trans('cms::utilities.backup.not_allowed',['task'=>$task]). trans('cms::utilities.field.executed_by',['name'=>$this->getCurrentUserName()]);
            $this->log->info($message);

            return $this->notifyError($message);
        }

        $this->command->call('backup:' . $task);
        $message = $task == 'clean' ? trans('cms::utilities.backup.cleanup_complete') : trans('cms::utilities.backup.complete');
        $this->log->info($message . trans('cms::utilities.field.executed_by',['name'=>$this->getCurrentUserName()]));

        return $this->notifySuccess($message);
    }

    /**
     * Get name of the current user.
     *
     * @return string
     */
    protected function getCurrentUserName()
    {
        return auth('administrator')->user()->present()->name();
    }

    /**
     * Clear cache manually.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function cache()
    {
        $this->command->call('cache:clear');
        $this->log->info(trans('cms::utilities.cache.success') . trans('cms::utilities.field.executed_by',['name'=>$this->getCurrentUserName()]));

        return $this->notifySuccess(trans('cms::utilities.cache.success'));
    }

    /**
     * Run config artisan command manually.
     *
     * @param string $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function config($task)
    {
        if (! in_array($task, ['cache', 'clear'])) {
            $message = trans('cms::utilities.config.not_allowed',['task'=>$task]). trans('cms::utilities.field.executed_by',['name'=>$this->getCurrentUserName()]);
            $this->log->info($message);

            return $this->notifyError($message);
        }

        $message = $task == 'cache' ? trans('cms::utilities.config.cache') : trans('cms::utilities.config.cache_cleared');
        $this->log->info($message . trans('cms::utilities.field.executed_by',['name'=>$this->getCurrentUserName()]));
        $this->command->call('config:' . $task);

        return $this->notifySuccess($message);
    }

    /**
     * Clear views manually.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function views()
    {
        $this->command->call('view:clear');
        $this->log->info(trans('cms::utilities.views.success').trans('cms::utilities.field.executed_by',['name'=>$this->getCurrentUserName()]));

        return $this->notifySuccess(trans('cms::utilities.views.success'));
    }

    /**
     * Log viewer.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Exception
     */
    public function logs(Request $request, Datatables $datatables)
    {
        if ($request->input('l')) {
            LaravelLogViewer::setFile(base64_decode($request->input('l')));
        }

        if ($request->input('dl')) {
            return response()->download(LaravelLogViewer::pathToLogFile(base64_decode($request->input('dl'))));
        } elseif ($request->has('del')) {
            File::delete(LaravelLogViewer::pathToLogFile(base64_decode($request->input('del'))));

            return redirect()->to($request->url());
        }

        $logs = LaravelLogViewer::all();

        if ($request->wantsJson()) {
            return $datatables->collection(collect($logs))
                              ->editColumn('stack', '{!! nl2br($stack) !!}')
                              ->editColumn('level', function ($log) {
                                  $content = $this->html->tag('span', '', [
                                      'class' => "glyphicon glyphicon-{$log['level_img']}-sign",
                                  ]);

                                  $content .= '&nbsp;' . $log['level'];

                                  return $this->html->tag('span', $content, ['class' => "text-{$log['level_class']}"]);
                              })
                              ->addColumn('content', function ($log) {
                                  $html = '';
                                  if ($log['stack']) {
                                      $html = '<a class="pull-right expand btn btn-default btn-xs"><span class="glyphicon glyphicon-search"></span></a>';
                                  }

                                  $html .= $log['text'];

                                  if (isset($log['in_file'])) {
                                      $html .= '<br>' . $log['in_file'];
                                  }

                                  return $html;
                              })
                              ->make(true);
        }

        return view('administrator.utilities.log', [
            'logs'         => $logs,
            'files'        => LaravelLogViewer::getFiles(true),
            'current_file' => LaravelLogViewer::getFileName(),
        ]);
    }

    /**
     * Rebuild menu entity nested set tree.
     */
    public function rebuildMenu()
    {
        Menu::rebuild(true);

        return $this->notifySuccess(trans('cms::utilities.menu.success'));
    }

    /**
     * Rebuild category entity nested set tree.
     */
    public function rebuildCategory()
    {
        Category::rebuild(true);

        return $this->notifySuccess(trans('cms::utilities.category.success'));
    }
}
