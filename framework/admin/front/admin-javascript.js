var toggleHandler = function(toggle) {
    var toggle = toggle;
    var radio = jQuery(toggle).find("input");

    var checkToggleState = function() {
        if (radio.eq(0).is(":checked")) {
            jQuery(toggle).removeClass("toggle-off");
        } else {
            jQuery(toggle).addClass("toggle-off");
        }
    };

    checkToggleState();

    radio.eq(0).click(function() {
        jQuery(toggle).toggleClass("toggle-off");
    });

    radio.eq(1).click(function() {
        jQuery(toggle).toggleClass("toggle-off");
    });
};
function setupLabel($) {
    // Checkbox
    var checkBox = ".checkbox";
    var checkBoxInput = checkBox + " input[type='checkbox']";
    var checkBoxChecked = "checked";
    var checkBoxDisabled = "disabled";

    // Radio
    var radio = ".radio";
    var radioInput = radio + " input[type='radio']";
    var radioOn = "checked";
    var radioDisabled = "disabled";

    // Checkboxes
    if (jQuery(checkBoxInput).length) {
        jQuery(checkBox).each(function(){
            jQuery(this).removeClass(checkBoxChecked);
        });
        jQuery(checkBoxInput + ":checked").each(function(){
            jQuery(this).parent(checkBox).addClass(checkBoxChecked);
        });
        jQuery(checkBoxInput + ":disabled").each(function(){
            jQuery(this).parent(checkBox).addClass(checkBoxDisabled);
        });
    };

    // Radios
    if (jQuery(radioInput).length) {
        jQuery(radio).each(function(){
            jQuery(this).removeClass(radioOn);
        });
        jQuery(radioInput + ":checked").each(function(){
            jQuery(this).parent(radio).addClass(radioOn);
        });
        jQuery(radioInput + ":disabled").each(function(){
            jQuery(this).parent(radio).addClass(radioDisabled);
        });
    };
};
jQuery(function($) {
	$('.navigation > li').click(function(){
		$(this).addClass("active").siblings().removeClass();
		$(".main > form > div").hide().eq($('.navigation > li').index(this)).fadeIn('fast');
	});
	$('.color-field').wpColorPicker();
    $(".toggle").each(function(index, toggle) {
        toggleHandler(toggle);
    });	
    $("html").addClass("has-js");
    $(".checkbox, .radio").prepend("<span class='icon'></span><span class='icon-to-fade'></span>");

    $(".checkbox, .radio").click(function(){
        setupLabel();
    });
    setupLabel();    
});