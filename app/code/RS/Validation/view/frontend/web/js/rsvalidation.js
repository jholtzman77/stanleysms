define([
    'Magento_Ui/js/lib/validation/validator',
    'jquery',
    'jquery/ui',
    'jquery/validate',
    'mage/translate'
], function(validator,$){
    'use strict';

    return function() {
        $.validator.addMethod(
            'rspostcode', function (value, element) {
                console.log(value.length);
                return value.length > 4 &&  value.length < 6 && value.match(/[0-9]/);
            }, $.mage.__('Please Input A Valid 5 Digit Zip Code - i.e 10002'));

        validator.addRule(
            'rspostcode', function (value, element) {
                console.log(value.length);
                return value.length > 4 &&  value.length < 6 && value.match(/[0-9]/);
            },$.mage.__('Please Input A Valid 5 Digit Zip Code - i.e 10002')
        );
    }
});
