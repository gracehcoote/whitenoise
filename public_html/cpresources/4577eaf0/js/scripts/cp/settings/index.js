$((function(){var e=$("#session-time"),a=$("#session-count"),s=$("#session-secret");$("select#session-context").on({change:function(){switch($(this).val()){case"payload":s.removeClass("hidden"),a.addClass("hidden"),e.addClass("hidden");break;case"session":case"database":s.addClass("hidden"),a.removeClass("hidden"),e.removeClass("hidden")}}}),$("input[name='purge-toggle']").parents(".lightswitch").on({change:function(){$("input",this).val()||$("select#purge-value").val(0)}}),$("select#spam-protection-behaviour").on({change:function(){var e=$("#custom-spam-error-message");"display_errors"===$(this).val()?e.show("fast"):e.hide("fast")}});var n=$('select[name="settings[scriptInsertLocation]"]'),t=$("#script-insert-warning").text();n.on({change:function(){var e=$(this).val(),a=$(this).parents(".field:first");if("manual"===e){var s=document.createElement("div");s.classList.add("warning","with-icon"),s.innerText=t,console.log(a,s),a.append(s)}else a.find(".warning.with-icon").remove()}}),n.trigger("change");var i=$("#files-directory"),o=$("#template-default");$("#storage-type").on({change:function(e){var a=e.target.value;["files","files_database"].includes(a)?i.removeClass("hidden"):i.addClass("hidden"),"files_database"===a?o.removeClass("hidden"):o.addClass("hidden")}});var r=$("#notifications-migrator");r&&$("#migrate",r).on({click:function(e){if(!confirm("Are you sure you want to migrate database notifications to file based ones?"))return e.preventDefault(),e.stopPropagation(),!1;var a,s,n,t=$("#remove-files",r).is(":checked");return $.ajax({url:Craft.getCpUrl("freeform/migrate/notifications/db-to-file"),type:"post",dataType:"json",contentType:"application/json",data:JSON.stringify((a={removeDbNotifications:t},s=Craft.csrfTokenName,n=Craft.csrfTokenValue,s in a?Object.defineProperty(a,s,{value:n,enumerable:!0,configurable:!0,writable:!0}):a[s]=n,a)),success:function(e){e.success&&r.html($('<div class="pane">\n                  <p>\n                    <span class="checkmark-icon"></span>\n                    Migrated successfully\n                  </p> \n                </div>\n                '))}}),e.preventDefault(),e.stopPropagation(),!1}})}));