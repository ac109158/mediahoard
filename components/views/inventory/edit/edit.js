var val1;
var val2;
var loaded;

function blink(selector) 
{
    $(selector).fadeOut('slow', function()
    {
        $(this).fadeIn('slow')
    });
};

////////////////////////////////////////////////////////////

function editable(name, label, div_label_text, div_edit, div_update, div_label, div_input, ext )
{
    console.log("detecting editable");
    $(div_label_text ).dblclick(function() 
    {
        $(div_edit).click();
        return false;
    });
    $(div_input).dblclick(function() 
    {
        $(div_update).click();
        return false;
    });
$(div_edit).on("click", function () 
    {
        loaded = false;
        $(this).addClass('hidden');
        $(div_update).removeClass('hidden');
        $(div_label).addClass('hidden');
        $(div_input).removeClass('hidden');
        $(label).select();
        val1 = $(label).val();
        $(div_input).keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
        $(div_update).click();
        return false;  
        }
        }); 
    });

$(div_update).on("click", function () 
    {
        $(this).addClass('hidden');
        $(div_edit).removeClass('hidden');
        $(div_label).removeClass('hidden');
        $(div_input).addClass('hidden');
        var val2= $(label).val();
        if (val1 == val2 ) {
            return false;
        }
        else
        {
            if (loaded == false)
            {
                update(name, val2,ext);
                $(div_label_text).text(val2);
                loaded =true;
            }
            
            return false;
        }
    });

}




 function update(field, value,ext)
    {
        var url = "index.php?controller=dashboards&task=update";               
        var dataString = "fieldID="+field+ext+"&fieldVal="+ value + "&id=" + id;
        
        jQuery.ajax({
            url: url,
            cache: false,
            type: "GET",
            data: dataString,
            success: function(html){
                window.onbeforeunload=null;
            }
        });

    }

editable('location', '#location', '#location-label-text', '#location-edit', '#location-update','#location-label', '#location-input', '');
editable('year', '#year', '#year-label-text', '#year-edit', '#year-update','#year-label', '#year-input', '');
editable('title', '#title', '#title-label-text', '#title-edit', '#title-update','#title-label', '#title-input', '');
editable('status', '#status', '#status-label-text', '#status-edit', '#status-update','#status-label', '#status-input', '');
editable('year', '#year', '#year-label-text', '#year-edit', '#year-update','#year-label', '#year-input', '');
editable('content', '#content', '#content-label-text', '#content-edit', '#content-update','#content-label', '#content-input', '_id');
editable('genre', '#genre', '#genre-label-text', '#genre-edit', '#genre-update','#genre-label', '#genre-input', '_id');
editable('rating', '#rating', '#rating-label-text', '#rating-edit', '#rating-update','#rating-label', '#rating-input', '_id');
editable('category', '#category', '#category-label-text', '#category-edit', '#category-update','#category-label', '#category-input', '_id');
editable('type', '#type', '#type-label-text', '#type-edit', '#type-update','#type-label', '#type-input', '_id');
editable('condition', '#condition', '#condition-label-text', '#condition-edit', '#condition-update','#condition-label', '#condition-input', '_id');
editable('privacy', '#privacy', '#privacy-label-text', '#privacy-edit', '#privacy-update','#privacy-label', '#privacy-input', '_id');