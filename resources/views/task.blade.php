<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/toastr.js/2.1.3/toastr.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/2.1.3/toastr.min.js"></script>

</head>
<body>
<div class="container">
    {{--task list--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            任务管理器
        </div>
        <div class="panel-body">
            <button class="btn btn-primary" id="add">添加任务</button>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Content</th>
                <th>Created_at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="task-list">
            @foreach($tasks as $task)
                <tr id="task{{ $task->id }}">
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->content }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>
                        <button  class="btn btn-info edit" value="{{ $task->id }}">编辑</button>
                        <button class="btn btn-warning delete" value="{{ $task->id }}">删除</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--Modal--}}
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
                    <h4 class="modal-title" id="task-title">编辑任务</h4>
                </div>
                <div class="modal-body">
                    <form id="task">
                        <div class="form-group">
                            <label for="tname" class="control-label">Name:</label>
                            <input id="tname" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label for="tcontent" class="control-label">Content:</label>
                            <textarea class="form-control" id="tcontent"></textarea>
                        </div>
                        {!! csrf_field() !!}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="tsave" class="btn btn-primary" value="update">提交</button>
                    <input type="hidden" id="tid" name="tid" value="-1">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        url = '/task/';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#task input[name="_token"]').val()
            }
        });
        $('#add').click(function () {
            $('#task-title').text('添加任务');
            $('#tsave').val('add');
            $('#taskModal').modal('show');
        });
        $('body').on('click', 'button.delete', function() {
            var tid = $(this).val();
            $.ajax({
                type: 'DELETE',
                url: url+tid,
                success: function (data) {
                    console.log(data);
                    $('#task'+tid).remove();
                    toastr.success('删除成功！');
                },
                error: function (data, json, errorThrown) {
                    console.log(data);
                    var errors = data.responseJSON;
                    var errorsHtml= '';
                    $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    toastr.error( errorsHtml , "Error " + data.status +': '+ errorThrown);
                }
            });
        });
        $('body').on('click', 'button.edit', function() {
            $('#task-title').text('编辑任务');
            $('#tsave').val('update');
            var tid = $(this).val();
            $('#tid').val(tid);
            console.log(url +tid);
            $.get(url +tid, function (data) {
                console.log(url+tid);
                console.log(data);
                $('#tname').val(data.name);
                $('#tcontent').val(data.content);
            });
            $('#taskModal').modal('show');
        });
        $('#tsave').click(function () {
            if($('#tsave').val() == 'add') {
                turl = url;
                var type = "POST"; // add
            }
            else {
                turl = url + $('#tid').val();
                var type = "PUT"; // edit
            }
            var data = {
                name: $('#tname').val(),
                content: $('#tcontent').val()
            };
            $.ajax({
                type: type,
                url: turl,
                data: data,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#taskModal').modal('hide');
                    $('#task').trigger('reset');
                    var task = '<tr id="task' + data.id + '">' +
                            '<td>'+ data.id +'</td>' +
                            '<td>'+ data.name +'</td>' +
                            '<td>'+ data.content +'</td>' +
                            '<td>'+ data.created_at +'</td>' +
                            '<td><button class="btn btn-info edit" value="'+ data.id +'">编辑</button> <button class="btn btn-warning delete" value="'+ data.id +'">删除</button>'+ '</td>' +
                            '<tr>';
                    console.log(task);
                    if(type == 'POST') {
                        $('#task-list').append(task);
                        toastr.success('添加成功！');
                    }
                    else { // edit
                        $('#task'+data.id).replaceWith(task);
                        toastr.success('编辑成功！');
                    }
                },
                error: function (data, json, errorThrown) {
                    console.log(data);
                    var errors = data.responseJSON;
                    var errorsHtml= '';
                    $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    toastr.error( errorsHtml , "Error " + data.status +': '+ errorThrown);
                }
            });
        });
    });
</script>
</body>
</html>
