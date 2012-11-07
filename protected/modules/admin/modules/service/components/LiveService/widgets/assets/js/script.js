/**
 * Created with JetBrains PhpStorm.
 * User: Goloveshko Iliya
 * Date: 07.11.12
 * Time: 13:12
 */


var liveService = {
    filledDays          :   [],

    serviceName         :   '',

    ssId                :   '',

    getFilledDaysUrl    :   '',

    getDataByDateUrl    :   '',

    init                :   function( options )
                            {
                                liveService.serviceName = options.serviceName;
                                liveService.ssId = options.ssId;

                                liveService.getFilledDaysUrl = '/admin/service/' + liveService.serviceName.toLowerCase() + '/getFilledDays';
                                liveService.getDataByDateUrl = '/admin/service/' + liveService.serviceName.toLowerCase() + '/getDataByDate';

                                liveService.getFilledDays();
                            },

    getFilledDays       :   function()
                            {
                                $.get(liveService.getFilledDaysUrl, {ssId : liveService.ssId})
                                .success(function(data) {

                                    liveService.filledDays = eval( data );
                                });
                            },

    highlight           :   function( date )
                            {
                                formattedDate = $.datepicker.formatDate('yy-mm-dd', date);;
                                return (liveService.filledDays.indexOf(formattedDate) > -1) ? [true, 'yeah'] : [true];
                            },

    getDataByDate       :   function( date )
                            {
                                $.get(liveService.getDataByDateUrl, {ssId : liveService.ssId, date : date})
                                .success(function(data) {

                                    response = $.parseJSON(data);


                                    for( field in response.data )
                                    {
                                        if( response.status == 'success' )
                                        {
                                            value = response.data[field];
                                        }
                                        else if( response.status == 'empty' )
                                        {
                                            value = '';
                                        }

                                        $('#' + liveService.serviceName + 'Input_' + field).val( value );
                                    }
                                });
                            }
}