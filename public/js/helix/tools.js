webpackJsonp([41],{265:function(e,n,t){e.exports=t(266)},266:function(e,n,t){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),function(e){var n=t(7),r=t.n(n);e(function(){e("#merge-primary, #merge-secondary").selectize(),e("#invalidate-tokens-btn").click(function(){e.ajax({url:locale.baseurl+"/helix/superadmin/regenerateall",type:"GET"}).done(function(){r()({title:"\nTokens Regenerated!",text:"All users now have to re-authenticate",type:"success",timer:2e3,showCancelButton:!1,showConfirmButton:!1})})}),e("#merge-people-btn").click(function(){var n=e("#merge-primary").val(),t=e("#merge-secondary").val();n&&t&&(window.location=locale.baseurl+"/helix/superadmin/person/merge/"+n+"/"+t)})})}.call(n,t(0))}},[265]);