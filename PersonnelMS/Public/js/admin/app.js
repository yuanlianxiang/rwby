function del(msg) { 
//    var msg = "您真的确定要删除吗？\n\n删除后将不能恢复!请确认！"; 
    if (confirm(msg)==true){ 
            return true; 
        }else{ 
            return false; 
    } 
    
} 

jQuery(document).ready(function () {
    //高亮当前选中的导航
    var myNav = $(".side-nav a");
    var navtoggle=$(".navbar-minimalize");
    for (var i = 0; i < myNav.length; i++) {
        var links = myNav.eq(i).attr("href");
        var myURL = document.URL;
        var durl=/http:\/\/([^\/]+)\//i;
        domain = myURL.match(durl);
        var result = myURL.replace("http://"+domain[1],"");
        if (links == result) {
            myNav.eq(i).parents(".dropdown").addClass("open");
        }
    }
    navtoggle.click(function(){
        if($('.navbar-collapse').offset().left<0){
            $("#side-left").removeClass('left-open').addClass('right-open');
            $("#page-wrapper").removeClass('left-open').addClass('right-open');
            //$(".navbar-user").removeClass('left-open').addClass('right-open');
        }else if($('.navbar-collapse').offset().left==0){
            $("#side-left").removeClass('right-open').addClass("left-open");
            $("#page-wrapper").removeClass('right-open').addClass("left-open");
            //$(".navbar-user").removeClass('right-open').addClass("left-open");
        }
    });
    // function addLeaveLayer() {
    //     window.parent.layer.open({
    //         type: 1,
    //         area: ['600px', '450px'],
    //         title: '添加员工',
    //         scrollbar:true,
    //         skin: 'layui-layer-molv' ,
    //         //border: [0],
    //         move:'.layui-layer-title',
    //         shadeClose: true, //点击遮罩关闭层
    //         content: $('#page-role-add'), //捕获的DIV
    //         btn: ['添加', '取消'],
    //         //page : {'#page-role-add'}
    //         cancel: function (index) {
               
    //         },
    //         yes: function () {
    //             //绑定提交表单时间
    //             $('#addrole-form-button').trigger('click');
    //              layer.close(index);
    //         }
    //     });
       
    // };
});


