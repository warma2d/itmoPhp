function Validator(form, config) {

    this._form = form;
    this._config = config;
    this._errors = [];


}

Validator.prototype.testRadio = function(name)
{
    let flag = false;
    let radios = this._form.querySelectorAll('input[name='+name+']');
    for(let i=0; i<radios.length; i++)
    {
        if(radios[i].checked === true)
        {
            flag = true;
        }
    }
    return flag;
};

Validator.prototype.test = function () {

    this._errors = [];
    let inputs = this._form.querySelectorAll('input');
    let inputName = '';
    let rules = [];
    let subRules = [];
    let min = 1;
    let max = 1;

    for(let i=0; i<inputs.length; i++)
    {
        inputName = inputs[i].name;// login
        if(inputName && this._config[inputName])
        {
            rules = this._config[inputName].split('|');
        }
        else
        {
            continue;
        }

        for(let k=0; k<rules.length; k++)
        {
            if(inputs[i].type !== 'checkbox' && rules[k] === 'required' /*&& inputName != ''*/)
            {
                if(inputs[i].value == '')
                {
                    this._errors.push('Поле ' + inputName + ' следует заполнить');
                    break;
                }
            }
            else
            {
                subRules = rules[k].split(':');
                if (subRules[0] == 'min') {
                    if (subRules[1] !== undefined) {
                        min = subRules[1];

                        if (inputs[i].value.length < min) {
                            this._errors.push('Поле ' + inputName + ' должно состоять минимум из ' + min + ' символов');
                        }
                    }
                } else if (subRules[0] == 'max') {
                    if (subRules[1] !== undefined) {
                        max = subRules[1];

                        if (inputs[i].value.length > max) {
                            this._errors.push('Поле ' + inputName + ' должно состоять максимум из ' + max + ' символов');
                        }
                    }
                }
            }

            if (inputs[i].type === 'checkbox' && rules[k] == 'checked')
            {
                if(inputs[i].checked === false)
                {
                    this._errors.push('Чекбокс ' + inputName + ' следует отметить');
                }
            }


            if(inputs[i].type === 'text' && rules[k] == 'email')
            {
                if(inputs[i].value.indexOf('@') === -1)
                {
                    this._errors.push( inputName + ' должен содержать собаку');
                }
            }

            if(inputs[i].type === 'radio' && rules[k] == 'checked')
            {
                if(this.testRadio(inputName) === false)
                {
                    this._errors.push('Радио кнопку ' + inputName + ' следует отметить');
                }
            }



        }
    }


    let selects = this._form.querySelectorAll('select')[0];
    if(selects)
    {
        if(selects.options[selects.selectedIndex].value == 'noselect')
        {
            this._errors.push('Вы не выбрали опцию в выпадающем списке');
        }
    }

    //console.log(this._errors);

    if(this._errors.length == 0 )
    {
        return true;
    }
    else
    {
        return false;
    }



};