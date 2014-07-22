/**
 * Created with JetBrains PhpStorm.
 * User: Ekstazi
 * Date: 09.07.13
 * Time: 0:03
 * To change this template use File | Settings | File Templates.
 */
(function($){
    function onSetup(ed)
    {
        ed.on("init",function(e) {
            ed.setContent($(ed.settings.hidden_input_id).val());
            ed.on('change submit',function(){
                $(this.settings.hidden_input_id).val(this.getContent());
            })
        });
    }
    $.fn.inlineTMCE=function(options){
        if(!options.hidden_input_id)
            return this.tinymce(options);

        var starter= $.Callbacks();
        starter.add(onSetup);
        if(options.setup)
            starter.add(options.setup);

        options.setup=$.proxy(starter,'fire');
        return this.tinymce(options);
    }
})(jQuery);