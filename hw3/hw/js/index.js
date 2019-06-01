window.onload = function () {

let response = document.getElementById('response');
response.style.display = 'none';

let config = {
    email:'required|email|max:255',
    password:'required|min:2|max:20',
    firstname:'required|min:2|max:20',
    hbdate:'required|min:10|max:10',
    sex:'checked',
};
form = document.getElementsByTagName('form')[0];
validator = new Validator(form, config);


form.addEventListener('submit', function(evt){
    if(! validator.test())
    {
        evt.preventDefault();
        let errors = '';
        for(let key in validator._errors)
        {
            errors += validator._errors[key]+'<br>';
        }
        responseHandler(errors);
    }
});


document.getElementById('sendAjaxBtn').addEventListener('click', function (evt) {
    evt.preventDefault();
    if(! validator.test())
    {
        console.log(validator._errors);

        let errors = '';
        for(let key in validator._errors)
        {
            errors += validator._errors[key]+'<br>';
        }
        responseHandler(errors);

    }
    else
    {

        let form_data = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", '/hw/register.php', true);
        xhr.send(form_data);
        xhr.onload = function (event) {
            if (xhr.status == 200) {
                responseHandler(xhr.responseText);
            }
            else
            {
                responseHandler('Ошибка при отправке ' + xhr.responseText);
            }
        }
    }
})

function responseHandler(text) {
    response.innerText = '';
    response.style.display = 'block';
    response.innerHTML = text;
    console.log(text);
}



};