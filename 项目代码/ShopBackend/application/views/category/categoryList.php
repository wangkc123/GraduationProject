<div class="col-md-10">
    <div class="row">
        <div class="col-xs-12">

            <div class="table-responsive" style="width: 80%;margin-left: 10%;margin-top: 5%">
                <span class="btn btn-sm btn-info add">添加分类<i class="icon-edit icon-on-right" style="margin-left:80%;"></i></span>
                &nbsp;&nbsp;&nbsp;共<b><?php echo $total['total'];?></b>种分类，上架<b><?php echo $total['up'];?></b>种分类，下架<b style="color: red"><?php echo $total['down'];?></b>种分类
                <table class="table table-bordered table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>商品数</th>
                        <th>图片</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $key => $value) {?>
                        <tr>
                            <td><?php echo $value['name']?></td>
                            <td><?php echo $value['num']?></td>
                            <td><img src="<?php echo $value['img_url']?>" style="width: 300px;height: 100px"></td>
                            <td>
                                <span class="btn btn-sm btn-info mod" _id="<?php echo $value['id']?>">修改<i class="icon-edit icon-on-right"></i></span>&nbsp;&nbsp;
                                <?php if ($value['is_delete'] == 0) {?>
                                <span class="btn btn-sm btn-danger del" _id="<?php echo $value['id']?>">下架<i class="icon-remove icon-on-right"></i></span>
                                <?php } else {?>
                                <span class="btn btn-sm btn-warning up" _id="<?php echo $value['id']?>">上架<i class="icon-remove icon-on-right"></i></span>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".mod").click(function(){
            var id = $(this).attr('_id');
            layui.use("layer",function(){
                layer.open({
                    type: 2,
                    area: ['50%','200px'],
                    shadeClose: true,
                    shade: 0.6,
                    content: './categoryEdit?active=1&id='+id,
                    end: function () {
                        window.location.href="./categoryList";
                    }
                });
            });
        });
        $(".del").click(function(){
            var id = $(this).attr('_id');
            var data = {
                active: 1,
                id: id
            };
            layui.use("layer",function() {
                layer.confirm('确定下架？', {icon: 3, title:'提示'}, function(index){
                    layer.close(index);
                    $.post('./categoryDel',data,function (res) {
                        if (res.match("^{(.+:.+,*){1,}}$")){
                            res = eval('(' + res + ')');
                            if (res.status == 200 ){
                                layui.use("layer",function() {
                                    layer.msg(res.desc);
                                    window.location.href="./categoryList";
                                });
                            }
                            layui.use("layer",function() {
                                layer.msg(res.desc);
                            });
                        } else {
                            layui.use("layer",function() {
//                                window.location.href="./categoryList";
                                layer.msg('操作失败，请联系管理员');
                            });
                        }
                    });
                });
            });
        });
        $(".up").click(function(){
            var id = $(this).attr('_id');
            var data = {
                active: 1,
                id: id
            };
            layui.use("layer",function() {
                layer.confirm('确定上架？', {icon: 3, title:'提示'}, function(index){
                    layer.close(index);
                    $.post('./categoryUp',data,function (res) {
                        if (res.match("^{(.+:.+,*){1,}}$")){
                            res = eval('(' + res + ')');
                            if (res.status == 200 ){
                                layui.use("layer",function() {
                                    layer.msg(res.desc);
                                    window.location.href="./categoryList";
                                });
                            }
                            layui.use("layer",function() {
                                layer.msg(res.desc);
                            });
                        } else {
                            layui.use("layer",function() {
//                                window.location.href="./categoryList";
                                layer.msg('操作失败，请联系管理员');
                            });
                        }
                    });
                });
            });
        });
        $(".add").click(function(){
            layui.use("layer",function(){
                layer.open({
                    type: 2,
                    area: ['50%','500px'],
                    shadeClose: true,
                    shade: 0.6,
                    content: './categoryAdd',
                    end: function () {
                        window.location.href="./categoryList";
                    }
                });
            });
        });
    });

</script>
