// JavaScript Document
$(function(){
	
	 Qfast.add('widgets', { path: "js/terminator2.2.min.js", type: "js", requires: ['fx'] });  
	 Qfast(false, 'widgets', function () {
		K.tabs({
			id: 'slide',   //焦点图包裹id  
			conId: "mslide",  //** 大图域包裹id  
			tabId:"fbtn",  
			tabTn:"a",
			conCn: '.fcon', //** 大图域配置class       
			auto: 1,   //自动播放 1或0
			effect: 'fade',   //效果配置
			eType: 'click', //** 鼠标事件
			pageBt:true,//是否有按钮切换页码
			bns: ['.prev', '.next'],//** 前后按钮配置class                          
			interval: 2000  //** 停顿时间  
		}); 
	});
	
	jQuery.jqtab = function(tabtit,tabcon) {
        $(tabcon).hide();
        $(tabtit+" li:first").addClass("thistab").show();
        $(tabcon+":first").show();
    
        $(tabtit+" li").bind("mouseover",function() {
            $(tabtit+" li").removeClass("thistab");
            $(this).addClass("thistab");
            $(tabcon).hide();
            var activeTab = $(this).find("a").attr("tab");
            $("#"+activeTab).slideDown(20).fadeIn();
            return false;
        });
        
    };
    $.jqtab("#tabs",".tab_con");
    $.jqtab("#tabs1",".tab_con1");
	$.jqtab("#tabs2",".tab_con2");
	$.jqtab("#tabs3",".tab_con3");
	$.jqtab("#tabs4",".tab_con4");
	
	
	
});