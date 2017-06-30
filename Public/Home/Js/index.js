/**
 * Created by Administrator on 2017/6/2.
 */

/**
 * 收藏商品操作
 */
$(document).ready(function () {
    $(".shoucang .ware-detail").click(function(){
        var $this = $(this);
        var id = $(this).attr('attr-id');
        // console.log(id);
        // 将获取到的数据post给服务器
        var url = SCOPE.coll_url;
        var data = {};
        var url_img = SCOPE.root + '/Public/Image/shoucanglove.png';
        var srcN = SCOPE.root + '/Public/Image/shoucang.png';
        // console.log(srcN);
        data['id'] = id;
        $.post(url,data,function(result){
            if(result.status == 1) {
                //成功
                if($this.attr('src')==srcN){
                    $this.attr('src',url_img);
                }else if($this.attr('src')==url_img){
                    $this.attr('src',srcN);
                }
            }
            else if(result.status == 0) {
                // 失败
                $this.attr('src',srcN);
            }
        },"JSON");
    });
});
