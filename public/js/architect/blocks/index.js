webpackJsonp([54],{229:function(e,o,t){e.exports=t(230)},230:function(e,o,t){(function(e){e(function(){e("#box-block table").dataTable({order:[2,"desc"],columnDefs:[{orderable:!1,targets:-1}],stateSave:!0}),e(".block-preview-btns").popover({trigger:"hover",placement:"left",container:"#box-block",html:!0,content:function(){var o=e(this).data("block");return e("#block"+o).clone()}})})}).call(o,t(0))}},[229]);