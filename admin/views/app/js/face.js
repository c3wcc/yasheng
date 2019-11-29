$(document).ready(function(e) {
    ImgIputHandler.Init();
});
var ImgIputHandler={
	facePath:[
	    {faceName:"微笑",facePath:"0.gif"},
		{faceName:"撇嘴",facePath:"1.gif"},
		{faceName:"色",facePath:"2.gif"},
		{faceName:"发呆",facePath:"3.gif"},
		{faceName:"得意",facePath:"4.gif"},
		{faceName:"流泪",facePath:"5.gif"},
		{faceName:"害羞",facePath:"6.gif"},
		{faceName:"发怒",facePath:"7.gif"},		{faceName:"憨笑",facePath:"8.gif"},
		{faceName:"调皮",facePath:"9.gif"},
		{faceName:"擦汗",facePath:"10.gif"},
		{faceName:"惊恐",facePath:"11.gif"},
		{faceName:"疑问",facePath:"12.gif"},
		{faceName:"晕",facePath:"13.gif"},
		{faceName:"抓狂",facePath:"14.gif"},
		{faceName:"坏笑",facePath:"15.gif"},
		{faceName:"阴险",facePath:"16.gif"},
		{faceName:"亲亲",facePath:"17.gif"},
		{faceName:"吓",facePath:"18.gif"},
		{faceName:"可怜",facePath:"19.gif"},
		{faceName:"傲慢",facePath:"20.gif"},
		{faceName:"龇牙",facePath:"21.gif"},
]
	,
	Init:function(){
		var isShowImg=false;
		$("#face").click(function(){
		var wrap = $("#faceWraps");               if(isShowImg==false){
				isShowImg=true;
				 wrap.show();
				if($("#faceWraps").children().length==0){
					for(var i=0;i<ImgIputHandler.facePath.length;i++){
						$("#faceWraps").append("<img title=\""+ImgIputHandler.facePath[i].faceName+"\" src=\"tinymce/tinymce/plugins/emoticons/img/"+ImgIputHandler.facePath[i].facePath+"\" />");
					}
					$("#faceWraps>img").click(function(){
isShowImg=false;
wrap.hide(); 
ImgIputHandler.insertAtCursor($("#comment")[0],"["+$(this).attr("title")+"]");
					});
				}
			}else{
			    isShowImg=false;
			    wrap.hide();
			}
		});
		$(".postBtn").click(function(){
			alert($("#comment").val());
		});
	},
	insertAtCursor:function(myField, myValue) {
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
        sel.select();
    } else if (myField.selectionStart || myField.selectionStart == "0") {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        var restoreTop = myField.scrollTop;
        myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length);
        if (restoreTop > 0) {
            myField.scrollTop = restoreTop;
        }
        myField.focus();
        myField.selectionStart = startPos + myValue.length;
        myField.selectionEnd = startPos + myValue.length;
    } else {
        myField.value += myValue;
        myField.focus();
    }
}
}