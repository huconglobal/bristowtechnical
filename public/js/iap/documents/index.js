webpackJsonp([32],{189:function(t,h,o){t.exports=o(190)},190:function(t,h,o){(function(t){t(function(){var h=document.location.hash;h?t('.nav-pills a[href="'+h.replace("tab_","")+'"]').tab("show"):t("#documents a:first").click(),t(".nav-pills a").on("shown.bs.tab",function(t){window.location.hash=t.target.hash.replace("#","#tab_")});var o=t(".two-col-layout"),a=t(".col-md-4",o),n=t(".col-md-8",o);a.height()>n.height()&&n.height(a.height()),t("#documents a").on("show.bs.tab",function(){a.height()>n.height()&&n.height(a.height())})})}).call(h,o(0))}},[189]);