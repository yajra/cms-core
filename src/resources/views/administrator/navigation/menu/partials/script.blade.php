<script>
    new Vue({
        el: '#form-container',
        methods: {
            generateSelectedItem: function (selectedKey, selectedValue) {
                $.blockUI();
                var singleArticleExtension = 5;
                $('#selected-type-key').val(selectedKey);
                $('#selected-type-value').val(selectedValue);
                $('#menu-items-modal').modal('hide');
                if (selectedKey == singleArticleExtension) {
                    this.initArticleDataTable();
                }
                var menuId = $('#menu-id').val();
                this.$http
                        .get('/administrator/navigation/menu/extensions/' + menuId + '?key=' + selectedKey)
                        .then(function (response) {
                            $('#menu-item-selected-container').html(response.data);
                            $('#menutype').val(selectedKey);
                            $.unblockUI();
                        });
            },
            initArticleDataTable: function () {
                var articlesDT = $('#articles-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/administrator/navigation/menu/articles',
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
        },
        ready: function() {
            this.generateSelectedItem({{$menu->extension_id}}, '{{$menu->extension->name}}');
        }
    });
</script>
