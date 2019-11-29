function my_tinymce_int(){
    tinymce.init({
          skin : "lightgray",
          theme: "modern",
          language: "zh_CN", 
          selector:"#editor_content ,#editor_excerpt",
          height: "560px",
          resize:false,
          menubar:false,
          branding: false,
          indent:false,
          relative_urls:false,
          remove_script_host:false,
          convert_urls:false,
          fix_list_elements:true,
          image_advtab: true,
codesample_languages: [
        {text: 'HTML/XML', value: 'markup'},
        {text: 'JavaScript', value: 'javascript'},
        {text: 'CSS', value: 'css'},
        {text: 'PHP', value: 'php'},
        {text: 'Ruby', value: 'ruby'},
        {text: 'Python', value: 'python'},
        {text: 'Java', value: 'java'},
        {text: 'C', value: 'c'},
        {text: 'C#', value: 'csharp'},
        {text: 'C++', value: 'cpp'}
    ],
extended_valid_elements:"a[*],altglyph[*],altglyphdef[*],altglyphitem[*],animate[*],animatecolor[*],animatemotion[*],animatetransform[*],circle[*],clippath[*],color-profile[*],cursor[*],defs[*],desc[*],ellipse[*],feblend[*],fecolormatrix[*],fecomponenttransfer[*],fecomposite[*],feconvolvematrix[*],fediffuselighting[*],fedisplacementmap[*],fedistantlight[*],feflood[*],fefunca[*],fefuncb[*],fefuncg[*],fefuncr[*],fegaussianblur[*],feimage[*],femerge[*],femergenode[*],femorphology[*],feoffset[*],fepointlight[*],fespecularlighting[*],fespotlight[*],fetile[*],feturbulence[*],filter[*],font[*],font-face[*],font-face-format[*],font-face-name[*],font-face-src[*],font-face-uri[*],foreignobject[*],g[*],glyph[*],glyphref[*],hkern[*],line[*],marker[*],mask[*],metadata[*],missing-glyph[*],mpath[*],path[*],pattern[*],polygon[*],polyline[*],radialgradient[*],rect[*],script[*],set[*],stop[*],lineargradient[*],style[*],m[*],v[*],vs[*],us[*],hide[*],svg[*],switch[*],symbol[*],text[*],textpath[*],title[*],tref[*],tspan[*],use[*],view[*],vkern[*],h1[*],h2[*],h3[*],h4[*],h5[*],h6[*],blockquote[*]",
toolbar1:"bold italic underline forecolor | link unlink blockquote pagebreak | copy paste charmap removeformat | table  image media emoticons",
toolbar2:"styleselect alignleft aligncenter alignright  | bullist numlist  outdent indent tablecontrols | download  codesample commenthide help | undo  redo fullscreen ",
style_formats: [
			{title: "Header 1", format: "h1"},
			{title: "Header 2", format: "h2"},
			{title: "Header 3", format: "h3"},
			{title: "Header 4", format: "h4"},
			{title: "Header 5", format: "h5"},
			{title: "Header 6", format: "h6"},
],
textpattern_patterns: [
     {start: '*', end: '*', format: 'italic'},
     {start: '**', end: '**', format: 'bold'},
     {start: '#', format: 'h1'},
     {start: '##', format: 'h2'},
     {start: '###', format: 'h3'},
     {start: '####', format: 'h4'},
     {start: '#####', format: 'h5'},
     {start: '######', format: 'h6'},
     {start: '1. ', cmd: 'InsertOrderedList'},
     {start: '* ', cmd: 'InsertUnorderedList'},
     {start: '- ', cmd: 'InsertUnorderedList'}
  ],
plugins: [
      'charmap',
      'download',
      'colorpicker',
      'commenthide',
	'emoticons',
	'fullscreen',
	'hr',
	'help',
	'image',
	'lists',
	'link',
	'media',
	'paste',
	'pagebreak',
	'tabfocus',
	'textcolor',
	'textpattern',
       'table',
       'codesample',
       'wordcount',
  ],  
});
}
function my_tinymce_editorswitch(){
$("#created").before('<span style="top:0px; width: 100%;"><span class="wp-editor-tabs"><button data-wp-editor-id="content" class="wp-switch-editor switch-tmce" id="content-tmce" type="button"  onclick="tinymce_active()">可视化</button><button data-wp-editor-id="content" class="wp-switch-editor switch-html" id="content-html" type="button" onclick="html_active()">文本</button></span></span>');
}
function html_active(){
tinymce.remove("#editor_content");
$('editor_content').innerHTML = tinyMCE.get('editor_content').getContent();
$("#post_bar").removeClass("tmce-active");
$("#post_bar").addClass("html-active");
}
function tinymce_active(){
my_tinymce_int();
$("#post_bar").removeClass("html-active");
$("#post_bar").addClass("tmce-active");
};
$(document).ready(function(){
my_tinymce_int();
my_tinymce_editorswitch();
$("#post_bar").addClass("tmce-active");
});
