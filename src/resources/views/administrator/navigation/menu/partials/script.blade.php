<script>
    new Vue({
        el: '#menu-app',
        data: {
            menu: window.menu,
            extensions: window.extensions,
            extension: {}
        },
        computed: {
            menuId: function () {
                return this.menu.id || "";
            }
        },
        methods: {
            setExtension: function (extension) {
                $.blockUI();
                this.extension = extension;
                $('#menu-items-modal').modal('hide');
                axios.get(YajraCMS.adminPath + '/navigation/menu/extensions/' + this.menuId + '?key=' + extension.id)
                    .then(function (response) {
                        $('#menu-item-selected-container').html(response.data);
                        $('#menutype').val(extension.id);
                        $.unblockUI();
                    });
            }
        },
        mounted: function () {
            this.setExtension(this.menu.extension);
            var articlesDT = $('#articles-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: YajraCMS.adminPath + '/navigation/menu/articles',
                columns: [
                    {data: 'id', name: 'articles.id', width: '20px'},
                    {data: 'title', name: 'articles.title'},
                    {data: 'category_title', name: 'categories.id'},
                    {data: 'published', name: 'articles.published', width: '20px'},
                    {data: 'authenticated', name: 'articles.authenticated', width: '20px'},
                    {data: 'order', name: 'articles.order', width: '20px'},
                    {data: 'created_at', name: 'articles.created_at', width: '100px'},
                    {data: 'updated_at', name: 'articles.updated_at', width: '100px'}
                ],
                buttons: [
                    'export',
                    'print',
                    'reset',
                    'reload'
                ],
                initComplete: function () {
                    $('#articles-table tbody').on('click', 'tr', function () {
                        var article = articlesDT.row(this).data();
                        $('#url').val(article.slug);
                        $('#selected-article-id').val(article.id);
                        $('#selected-article-title').val(article.plain_title);
                        $('#articles-list-modal').modal('hide');
                    });

                    this.api().columns().every(function () {
                        var that = this;
                        $('input', this.footer())
                            .on('change', function () {
                                that.search($(this).val()).draw();
                            });
                        $('select', this.footer())
                            .on('change', function () {
                                that.search($(this).val()).draw();
                            });
                    });
                }
            });
        }
    });
</script>
