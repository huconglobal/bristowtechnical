webpackJsonp([15],{2:function(t,e,n){"use strict";(function(t){e.a={init:function(){var e=t("#hierarchy-modal");e.on("show.bs.modal",function(e){var n=t(e.relatedTarget),i=n.data("entity"),a=n.data("entity-id");t(".modal-body",this).html(t(".hidden .loader").clone()).load(locale.baseurl+"/arch/ajax/"+i+"/hierarchy/"+a)}),e.on("click",".hierarchy-btn",function(){var e=t(this).parent().children("ul"),n="block"===e.css("display")?"plus":"minus";t("i",this).attr("class","fa fa-"+n+"-square-o"),e.fadeToggle()}),e.on("click","#collapse-all",function(){t("ul",e).not("ul:first",e).fadeOut(),t(".hierarchy-btn i").attr("class","fa fa-plus-square-o")}),e.on("click","#expand-all",function(){t("ul",e).not("ul:first",e).fadeIn(),t(".hierarchy-btn i").attr("class","fa fa-minus-square-o")}),t(document).on("click",".block-event-list .event-btn",function(){t(".block-event-list .event-btn").removeClass("active"),t(this).addClass("active")})},removeItem:function(t,e){t.parents("tr").fadeOut(function(){this.remove(),e()})},initTextareaPopouts:function(){t(document).on("focus","[data-toggle=popout]",function(){var e=t(this),n=e.offset(),i=t("body"),a=i.outerWidth(),s=i.outerHeight(),o=e.outerWidth(),l=e.outerHeight(),r=a<=o+150?a:o+150,c=s<=l+150?s:l+150,h=e.css("font-size"),d=t("<textarea>").attr("class",e.attr("class")).addClass("popout").html(e.val()).css({position:"absolute",top:n.top,left:n.left,width:o,height:l,zIndex:1e3,fontSize:h}).keydown(function(t){if(9===(t.keyCode||t.which)){t.preventDefault();var n=e.closest("form").find(":input"),i=t.shiftKey?-1:1;n.eq(n.index(e)+i).focus()}}).blur(function(){return e.val(d.val()),d.animate({width:o,height:l,top:"+=75",left:"+=75"},200,function(){d.remove()})}).appendTo(i).animate({width:r,height:c,top:"-=75",left:"-=75"},200).focus();return!0})}}}).call(e,n(0))},227:function(t,e,n){t.exports=n(228)},228:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),function(t){var e=n(7),i=n.n(e),a=n(2),s=n(3);a.a.init(),t(function(){t('a[data-toggle="tab"]').on("shown.bs.tab",function(e){var n=t(e.target).attr("href"),i=t(".checkitems",t(n)).get(0);s.a.postRender(i)}),t("#event-box .checklist").each(function(e){var n=t(".checkitems",this);s.a.insertShuttleAndSilentElements(n),0===e&&s.a.postRender(n)}),t(".event-btn").click(function(){t(".active",".block-event-list").removeClass("active"),t(this).addClass("active");var e=t(this).text(),n=t(this).data("event-id");t("#event-box .box-title").html(e+" <small>"+n+"</small>")}),t("#block-edit-btn.disabled").click(function(){return!1}),t("#block-delete-btn").click(function(e){if(e.preventDefault(),!t(this).hasClass("disabled")){var n=t(this).parents("form");i()({title:helix.pleaseConfirm,text:helix.deleteTheBlock},function(){n.submit()})}})})}.call(e,n(0))},3:function(t,e,n){"use strict";(function(t){e.a={postRender:function(e){var n=this;t(".regitem-row, .memitem-row, .repositem-row",e).each(function(){n.positionSilentInElement(t(".desc-column",this))})},insertShuttleAndSilentElements:function(e){var n=this;t(".regitem-row, .memitem-row, .repositem-row",e).each(function(){var e=t(this),i=t(".desc-column",e);(e.hasClass("silent-item")||e.hasClass("nonsilent-item"))&&(t("td",e).first(),n.insertSilentIntoElement(i)),e.hasClass("shuttle")&&i.prepend('<span class="shuttle-arrow"></span>')})},insertSilentIntoElement:function(e){var n=[],i=e.contents().get().reverse(),a='<span class="'+(e.parent().hasClass("silent-item")?"dashed":"solid")+'-line"></span>',s=!0;if(t(i).each(function(){if(3===this.nodeType)this.data.trim().length&&(s=!1),n.push(t(this));else if(["SPAN","STRONG","B"].includes(this.nodeName))s=!1,n.push(t(this));else{if(n.length&&!s)return;if(["P","H4"].includes(this.nodeName))return void t(this).append(a);if(["OL","UL"].includes(this.nodeName)){var e=t(this).children().last(),i=t("h4",e);i.length?i.append(a):e.append(a)}}}),n.length){var o="";if(n.forEach(function(t){3===t[0].nodeType?t[0].data.trim().length&&(o=t[0].data+o):o=t[0].outerHTML+o}),o.trim().length>0){o="<p>"+o+" "+a+"</p>";for(var l=0;l<n.length;l+=1)n[l].remove();e.append(o)}}},positionSilentInElement:function(e){var n=t(".dashed-line, .dotted-line, .solid-line",e);if(n.length){var i=n.position().left,a=Math.floor(e.width()+parseInt(e.css("padding-left"),10)-i);a>15?(n.css({"margin-left":3}),n.width(a-3)):n.width(a)}}}}).call(e,n(0))}},[227]);