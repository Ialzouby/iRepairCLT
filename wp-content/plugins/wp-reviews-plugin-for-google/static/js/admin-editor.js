(function(){tinymce.create("tinymce.plugins.trustindex",{init:function(a,b){let jq_url=(typeof ajax_object!="undefined"?ajax_object.ajax_url:window.ajaxurl||null);if(!jq_url){return}a.addButton("trustindex",{title:"Add Trustindex widget shortcode",cmd:"add-trustindex-widget",image:b+"/../img/trustindex-sign-logo.png",text:""});a.addCommand("add-trustindex-widget",function(){jQuery.get(jq_url+"?action=list_trustindex_widgets",function(c){a.windowManager.open({title:"Please add an Trustindex widget ID!",body:[{type:"container",name:"container",label:"",html:c},{type:"textbox",name:"widget-id",placeholder:"Trustindex widget ID",multiline:false,minWidth:200}],onsubmit:function(f){var d=f.data["widget-id"];if(d.length<10){alert("Trustindex ID is missing or too short. Please check, mayba a copy-paste error!");return false}else{a.execCommand("mceInsertContent",0,'[trustindex data-widget-id="'+d+'"]')}}})});jQuery("body").on("click",".btn-copy-widget-id",function(c){let selected_class="text-danger";c.preventDefault();let link=jQuery(this);let id=link.data("ti-id");link.closest(".mce-form").find("input").val(id).trigger("change");link.closest(".mce-form").find(".btn-copy-widget-id."+selected_class).each(function(d,e){jQuery(e).removeClass(selected_class).find(".dashicons").attr("class","dashicons dashicons-admin-post")});link.addClass(selected_class).find(".dashicons").attr("class","dashicons dashicons-yes")})})},createControl:function(b,a){return null},getInfo:function(){return{longname:"Trustindex Buttons",author:"Trustindex.io - Velvel ltd[www.velvel.hu]",authorurl:"https://www.trustindex.io/",infourl:"https://www.trustindex.io/",version:"1.1"}}});tinymce.PluginManager.add("trustindex",tinymce.plugins.trustindex)})();