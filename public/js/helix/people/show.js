(window.webpackJsonp=window.webpackJsonp||[]).push([[29],{270:function(t,e,n){t.exports=n(271)},271:function(t,e,n){"use strict";n.r(e),function(t){var e=n(6),i=n.n(e);t((function(){t(".delete-btn").click((function(e){e.preventDefault();var n=t(this).parents("form"),r=t(this).data("warning");i()({title:helix.pleaseConfirm,text:r},(function(){return n.submit()}))})),t("#person-delete").click((function(e){e.preventDefault();var n=t(this).parents("form"),r=helix.confirmTrash;t(this).data("has-user")&&(r+=" ".concat(helix.accountWillBeDeleted)),i()({title:helix.pleaseConfirm,text:r},(function(){return n.submit()}))}))}))}.call(this,n(1))}},[[270,0,1]]]);