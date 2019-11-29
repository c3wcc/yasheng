/**
 * editor编辑器插入
 */

 loadEditor('content');
 loadEditor('excerpt');


function addattach_img(fileurl,imgsrc,aid, width, height, alt){
    if (editorMap['content'].designMode === false){
        EmlogMsgNotify('warning','','请先切换到所见所得模式','top right');
    }else if (imgsrc != "") {
        editorMap['content'].insertHtml('<a target=\"_blank\" href=\"'+fileurl+'\" id=\"ematt:'+aid+'\"><img src=\"'+imgsrc+'\" title="点击查看原图" alt=\"'+alt+'\" border=\"0\" width="'+width+'" height="'+height+'"/></a>');
    }
}
function addattach_file(fileurl,filename,aid){
    if (editorMap['content'].designMode === false){
        EmlogMsgNotify('warning','','请先切换到所见所得模式','top right');
    } else {
        editorMap['content'].insertHtml('<span class=\"attachment\"><a target=\"_blank\" href=\"'+fileurl+'\" >'+filename+'</a></span>');
    }
}

