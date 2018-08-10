jQuery(document).ready(function() {
	"use strict";
	
	jQuery('#customize-info').append('<a style="width: 94%; display: inline-block; text-align: center; margin: 2% 3% 1% 3%;" href="'+steed_objectL10n.btn_1_url+'" class="button button-primary" target="_blank">{btn_1_text}</a>'.replace('{btn_1_text}',steed_objectL10n.btn_1_text));
	
	jQuery('#customize-info').append('<div style="padding:5px; background:#359a34; color:#fff;">{text}</div>'.replace('{text}',steed_objectL10n.text));
	
	
	
});
