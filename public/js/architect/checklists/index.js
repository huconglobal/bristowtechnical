(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{228:function(t,a,e){t.exports=e(229)},229:function(t,a,e){(function(t){t((function(){var a=helix.first||"",e=sessionStorage.getItem("selectedDocrevision");(e="none"!==e&&e?e:a)&&t("#docrevision").val(e);var n=t("#checklists").DataTable({ajax:{url:"".concat(helix.ajaxUrl,"/").concat(e)},autoWidth:!1,columns:[{data:"chapter",type:"chapter"},{data:function(t){return"".concat(t.name," <small>").concat(t.id,"</small>")}},{data:"button",orderable:!1}],order:[[0,"asc"],[1,"asc"],[2,"asc"]],processing:!0,stateSave:!0});t("#docrevision").selectize({allowEmptyOption:!0,render:{item:function(t){return"<div>".concat(t.optgroup?"".concat(t.optgroup," - "):"").concat(t.text,"</div>")}}}).change((function(){sessionStorage.setItem("selectedDocrevision",t(this).val());var a="none"===t(this).val()?"":t(this).val();n.ajax.url("".concat(helix.ajaxUrl,"/").concat(a)),n.ajax.reload()})),helix.canWrite&&t("#checklists_filter").append(t("<a>").addClass("btn btn-success btn-sm pull-right").attr("href",helix.createUrl).append(t("<i>").addClass("fa fa-plus")).tooltip({title:helix.lang.newChecklist,container:"body",placement:"left"}))}))}).call(this,e(1))}},[[228,0,1]]]);