/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    $(document).ready(function(){

        delivery.onsubmit = function(e){
            e.preventDefault();
            let data_form = new FormData(delivery);
            const type = $('#id_type_delivery')['0'].value;
            var action = '';
            if (type=="0") {
                action = $('.regular')['0'].textContent;
            } else if(type == "1") {
                action = $('.fast')['0'].textContent;
            }

            if (action != '') {
                fetch(action,{
                    method:'POST',
                    body: data_form
                }).then(response => {
                    return response.json()
                }).then(respJson => {
                    var data = '';
                    for (var key in respJson) {
                        if (typeof respJson[key] === 'object') {
                            for (var ob_key in respJson[key]) {
                                data = data + key + ': ' + ob_key + ': ' + respJson[key][ob_key] + "; ";
                            }
                        } else {
                            data = data + respJson[key] + '; ';
                        }
                    }
                    console.log(respJson);
                    alert(data);
                    //$('.result_server')['0'].textContent=data;
                    var price='';
                    var date='';
                    var error='';
                    const type = $('#id_type_delivery')['0'].value;
                    if (type=="0") {
                        price = Number(respJson['coefficient'])*150;
                        date = respJson['date'];
                        error = respJson['error'];
                    } else if(type == "1") {
                        price = respJson['price'];
                        error = respJson['error'];
                        date = new Date();
                        date.setDate(date.getDate()+respJson['period']);
                        date = date.toJSON();
                        date = date.substring(0, 10);
                    }
                    var output_data = {
                        "price":price,
                        "date": date,
                        "error":error };
                    const json_return = JSON.stringify(output_data);
                        $('.result_server')['0'].textContent = json_return;
                })
            }
        };



        
        
        
    });
});
