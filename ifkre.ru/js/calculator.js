var model = {
    box1: {
        items: [
            {
                title: 'Юридический статус',
                name: 'status',
                type: 'radio',
                items: [
                    {
                        name: 'Физическое лицо',
                        value: 'phys',
                        index: '1'
                    },
                    {
                        name: 'Юридическое лицо',
                        value: 'yur',
                        index: '2'
                    },
                    {
                        name: 'Индивидуальный предприниматель',
                        value: 'ind',
                        index: '3'
                    }
                ],
                dict: "Заявитель"
            },
            {
                title: 'Объект технологического присоединения',
                name: 'object',
                type: 'radio',
                items: [
                    {
                        name: 'Частный жилой дом',
                        value: 'house',
                        index: '1',
                        rate: true
                    },
                    {
                        name: 'Коммерческий объект',
                        value: 'commerc',
                        index: '2',
                        rate: false
                    }
                ],
                dict: 'Объект технологического присоединения'
            },
            {
                title: 'Значение максимального часового расхода газа, куб. м',
                name: 'rash',
                type: 'text',
                val: 'met',
                rel: 'rate',
                placeholder: 'Введите значение в куб.м.',
                dict: 'Максимальный часовой расход газа'
            }
        ],
        control: {
            type: 'next',
            value: 'Далее',
            next: "box2"
        },
        info: {
            name: 'box1',
            id: '#box1',
            stat: '',
            next: "box2"
        }
    },
    box2: {
        items: [
            {
                title: 'Расстояние от дома до границы участка, м',
                name: 'rast1',
                type: 'text',
                val: 'met',
                placeholder: 'Введите значение в метрах',
                hint: 'Значение расстояния до сети газораспределения в границах участка',
                dict: 'Расстояние от дома до границы участка'
            },
            {
                title: 'Протяженность газопровода от границ участка до источника, м',
                name: 'rast2',
                type: 'text',
                val: 'met',
                placeholder: 'Введите значение в метрах',
                hint: 'Значение расстояния до сети газораспределения за границами участка',
                cond: {
                    stat: 'hide',
                    name: 'checkBuildCond',
                    hint: 'Газораспределительная сеть - газопроводы, обеспечивающие подачу газа от источников газоснабжения до газопровода-ввода потребителя газа. Необходимость строительства сети газораспределения будет определена после подачи заявки о подключении и отражена в технических условиях'
                },
                dict: 'Протяженность газопровода от границ участка до источника'
            },
            {
                title: 'Давление в проектируемом газопроводе',
                name: 'pressure',
                type: 'radio',
                items: [
                    {
                        name: 'Низкое до 0,005 МПа',
                        value: 'low',
                        index: '1',
                        hint: 'Используется для подачи газа к оборудованию бытовых потребителей и предприятий бытового сектора.',
                        dict: 'Низкое'
                    },
                    {
                        name: 'Среднее от 0,005 МПа до 0,3 МПа',
                        value: 'medium',
                        index: '2',
                        hint: 'Используется для подведения газа к газораспределительным пунктам, расположенным непосредственно на зданиях либо вблизи них.',
                        dict: 'Среднее'
                    },
                    {
                        name: 'Высокое II категории от 0,3 до 0,6 МПа',
                        value: 'hight',
                        index: '2',
                        hint: 'Используются для подачи газа к газораспределительным пунктам внутри городской черты и к промышленным потребителям.',
                        dict: "Высокое"
                    },
                    {
                        name: 'Высокое I категории от 0,6 до 1,2 МПа',
                        value: 'extra',
                        index: '2',
                        hint: 'Используется для подачи газа до газораспределительных пунктов и промышленным потребителям.',
                        dict: 'Очень высокое'
                    }
                ],
                dict: 'Давление в проектируемом газопроводе'
            }, {
                title: 'Источник газоснабжения',
                name: 'source',
                type: 'radio',
                hint: 'Газопровод, к которому осуществляется подключение',
                items: [
                    {
                        name: 'Полиэтиленовый газопровод',
                        value: 'poly',
                        index: '1'
                    },
                    {
                        name: 'Стальной газопровод',
                        value: 'steel',
                        index: '2'
                    }
                ]
            }, {
                title: 'Особые условия',
                name: 'special',
                type: 'checkbox',
                hint: 'Условия при которых размер платы за технологическое присоединение устанавливается органами исполнительной власти субъектов РФ по индивидуальному проекту после его разработки и экспертизы.',
                items: [
                    {
                        name: 'проведение врезки в газопроводы диаметром не менее 250 мм под давлением не менее 0,3 МПа',
                        value: 'insert',
                        index: '1'
                    },
                    {
                        name: 'проведение лесоустроительных работ',
                        value: 'wood',
                        index: '2'
                    },
                    {
                        name: 'прокладка газопровода методом горизонтально-направленного бурения',
                        value: 'drilling',
                        index: '2'
                    },
                    {
                        name: 'прокладка по болотам 3-его типа, и(или) в скальных породах, и(или) на землях особо охраняемых природных территорий',
                        value: 'bog',
                        index: '2'
                    }
                ]
            }
        ],
        control: {
            type: 'next',
            next: "box3",
            value: 'Далее'
        },
        info: {
            name: 'box2',
            id: '#box2',
            stat: '',
            next: "finish"
        }
    },
    box3:
            {
                items:
                        [
                            {
                                name: 'adres',
                                type: 'text',
                                placeholder: 'Адрес объекта технологического присоединения'
                            },
                            {
                                name: 'name',
                                type: 'text',
                                placeholder: 'Как вас зовут ?'
                            },
                            {
                                name: 'phone',
                                type: 'text',
                                placeholder: 'Номер телефона'
                            }
                        ],
                control: {
                    type: 'submit',
                    value: 'Рассчитать'
                },
                info: {
                    name: 'box3',
                    id: '#box3',
                    stat: 'done',
                    next: "finish"
                }
            }
};
/*
 var variants = {
 sum1: 6045.19,
 sum2: 6045.19,
 sum3: 20335.90,
 sum4: 23996.36,
 sum5: 6656.89,
 sum6: 6656.89,
 sum7: 20335.90,
 sum8: 23996.36
 };*/
var option = listOption;
var consts = listConst;
/*var consts = {
 K: 7.9,
 C2: 107.74,
 C5: 74.83,
 Cct8: 4146.7,
 Cpe8: 5795.99,
 C1: 9244.4,
 Cct3: 146154.32,
 Cpe3: 112154.91
 };*/
var destination = $(".zayvaka_content").offset().top;

function formBlock(box) {
    this.items = box.items;
    this.info = box.info;
    this.control = box.control;
    this.changelink = $('<a class="box_select" href="#">изменить</a>');
    this.renderBlock = function () {
        $('.zayavka_form').calcForm('renderBlock', this.items, this.control, this.info);
    };
    this.show = function () {
        if (this.info.stat === "ready") {
            $(this.info.id + ' .box_select').remove();
        }
        $(this.info.id).addClass('is-active');
        $(this.info.id + ' .box_cont').show(500);
        $("html:not(:animated),body:not(:animated)").animate({
            scrollTop: destination
        }, 200);
    };
    this.checkReady = function (block) {
        var key = true;
        $.each(block.items, function (i, item) {
            if (item === undefined || item === "")
                key = false;
        });
        if (key) {
            if (this.info.stat !== 'ready') {
                $('.zayavka_form').calcForm('setActiveNext', this.control, this.info);
                this.info.stat = 'ready';
            }
        } else {
            if (this.info.stat === 'ready') {
                $('.zayavka_form').calcForm('removeActiveNext', this.control, this.info);
                this.info.stat = 'done';
            }
        }
    };
    this.hide = function () {
        if (this.info.stat === "ready") {
            var id = this.info.name;
            this.changelink.click(function (e) {
                e.preventDefault();
                $('.zayavka_form').calcForm('changeBlock', id);
            });
            $(this.info.id + ' h3').append(this.changelink);
        }
        $(this.info.id).removeClass('is-active');
        return $(this.info.id + ' .box_cont').hide(500);
    };
}

(function ($) {
    //var controller = {};
    var collection = {}; // коллекция блоков класса formBlock;
    var active = ""; // текущий активный элемент
    var rateId = "rate_calc";
    var resultSum = "";
    var resulText = "";
    var special = false;
    var specialId;
    var specialText = "Стоимость подключения будет определена после разработки проекта, проведения его экспертизы и утверждения размера платы по индивидуальному проекту";
    var resultSumBlock = "";
    var resultSumId = 'calc_result';
    var sumText = "Ориентировочная стоимость подключения";
    var dictonary = {};
    var resultTextId;
    var getMessage = function(name) {
        return ( dictonary[name] !== undefined) ? dictonary[name] : name;
    };
    var methods = {
        init: function () {
            var $this = $(this);
            $this.on('keypress', 'input.met', function (event) {
                if ((event.charCode >= 48 && event.charCode <= 57) || (event.charCode === 0 && (event.keyCode === 8 || event.keyCode === 46)))
                    return;
                else {
                    if (event.charCode === 46) {
                        if ($(this).val().indexOf('.') === -1)
                            return;
                    }
                    if (event.charCode === 44) {
                        if ($(this).val().indexOf('.') === -1)
                            $(this).val($(this).val() + '.');
                    }
                }
                event.preventDefault();
                return;
            });
            $this.removeClass('loader');
            $this.append('<div class="block" id="box1"><h3>Основные данные об объекте</h3></div>');
            $this.append('<div class="block" id="box2"><h3>Данные о газопроводе </h3></div>');
            $.each(model, function (i, item) {
                collection[i] = new formBlock(item);
            });
            collection.box1.renderBlock();
            collection.box2.renderBlock();
            collection.box2.hide();
            $this.children('.zcb_inputs').append('<div class="block" id="box3"><h3>Результат расчёта</h3><div class="box_cont"></div></div>');
            //collection.box3.renderBlock();
            //collection.box3.hide();
            $(this).calcForm('renderSumBlock');
            //collection.box3.renderBlock();
            /*$this.on('click', '.box_select', function(e){
             e.preventDefault();
             collection[active].hide();
             
             console.log($(this));
             collection[active].show();
             });*/
            //$(collection.box1.info.id).bind('click.calcForm', methods.click);
            $this.on('submit', function (e) {
                e.preventDefault();
                var result = $(this).serializeArray();
                $(this).calcForm('existResult', result);
            });
        },
        renderSumBlock: function () {
            specialId = $('<div></div>');
            resultSumBlock = $('<div class="gaz_sumblock"><p>' + sumText + '</p><p id=' + resultSumId + '></p></div>');
            resultTextId = $('<div></div>');
            $("#box3 .box_cont").append(specialId);
            $("#box3 .box_cont").append(resultSumBlock).append(resultTextId).hide();
            $("#box3 .box_cont").append('<div class="zayavka_send"><a class="btn_f" href="/fl/gaz/tp/zayavka">Подать заявку</a></div>');
        },
        changeBlock: function (id) {
            collection[active].hide();
            if (id === 'box1') {
                $('.block').not('#' + id).find('.box_select').remove();
            }
            if (id === 'box2') {
                $('#box3').find('.box_select').remove();
            }
            active = id;
            collection[active].show();
        },
        setActiveNext: function (control, box) {
            /* if (box.next !== 'finish') {
             $(box.id + ' .btn_f').click(function (e) {
             e.preventDefault();
             collection[control.next].show();
             collection[box.name].hide();
             active = control.next;
             });
             } else {
             $(this).on('submit', function (e) {
             e.preventDefault();
             var result = $(this).serializeArray();
             $(this).calcForm('existResult', result);
             });
             }*/
            if (box.next !== 'finish') {
                $(box.id + ' .btn_f').click(function (e) {
                    e.preventDefault();
                    collection[control.next].show();
                    collection[box.name].hide();
                    active = control.next;
                });
            } else {
                var $this = $(this);
                $(box.id + ' .btn_f').click(function (e) {
                    e.preventDefault();
                    collection[control.next].show();
                    collection[box.name].hide();
                    active = control.next;
                    $this.trigger('submit');
                });
            }
            $(box.id + ' .btn_f').removeClass('blocked');
        },
        existResult: function (result) {
            var values = {};
            var variant;
            var flag = true;
            for (key in result) {
                values[result[key]['name']] = result[key]['value'];
            }
            if (values.special === undefined) {
                if ((+values.rast1 + +values.rast2) < 201) {
                    if ((values.pressure === 'low' || values.pressure === 'medium')) {
                        if (values.object === "house" && values.rash < 6) {
                            if (values.status === "yur") {
                                if (values.build === 'y') {
                                    variant = 'sum4';
                                } else {
                                    variant = 'sum2';
                                }
                            } else {
                                if (values.build === 'y') {
                                    variant = 'sum3';
                                } else {
                                    variant = 'sum1';
                                }
                            }
                        } else if (values.object === "commerc" && values.rash < 16) {
                            if (values.status === "yur") {
                                if (values.build === 'y') {
                                    variant = 'sum8';
                                } else {
                                    variant = 'sum6';
                                }
                            } else {
                                if (values.build === 'y') {
                                    variant = 'sum7';
                                } else {
                                    variant = 'sum5';
                                }
                            }
                        } else {
                            variant = 'calc';
                        }
                    } else {
                        variant = 'calc';
                    }
                } else {
                    variant = 'calc';
                }
            } else {
                console.log('special');
                variant = 'calc';
                special = true;
            }
            if (variant === 'calc') {
                if ((+values.rast1 + +values.rast2) <= 150) {
                    if (values.source === 'steel') {
                        variant = 'calc1';
                    } else {
                        variant = 'calc2';
                    }

                } else {
                    if (values.source === 'steel') {
                        variant = 'calc3';
                    } else {
                        variant = 'calc4';
                    }
                }
                flag = false;
            }
            if (flag) {
                resultSum = option[variant].val;
                resultText = option[variant].text;
            } else {
                $(this).calcForm('calcResult', variant, values);
                resultText = listCalc[variant].text;
            }
            $(this).calcForm('setResultSum', values);
        },
        calcResult: function (calcVariant, result) {
            var res;
            switch (calcVariant) {
                case 'calc1':
                    res = (consts.C2 * parseFloat(result.rash) + consts.C5 * parseFloat(result.rash) * consts.K + consts.Cct8);
                    break;
                case 'calc2':
                    res = (consts.C2 * parseFloat(result.rash) + consts.C5 * parseFloat(result.rash) * consts.K + consts.Cpe8);
                    break;
                case 'calc3':
                    res = (consts.C1 + (consts.Cct3 * (result.rast1 * 1 + result.rast2 * 1)) / 1000 * consts.K + consts.Cct8);
                    break;
                case 'calc4':
                    res = (consts.C1 + (consts.Cpe3 * (result.rast1 * 1 + result.rast2 * 1)) / 1000 * consts.K + consts.Cpe8);
                    break;
            }
            resultSum = res.toFixed(2);
            return resultSum;
        },
        setResultSum: function (values) {
            $('#' + resultSumId).html(resultSum);
            if (special === true) {
                specialId.html("<p>" + specialText + "</p>");
                special = false;
            } else {
                specialId.html("");
            }
            var list = $('<ul class="calc_list"></ul>');
            var iList;
            $.each(values, function(i, item) {
                var m = (i === 'rast1' || i === 'rast2') ? ' м' : (i === 'rash') ? ' куб. м' : '';
                iList = $("<li><span>"+getMessage(i)+"</span><span>"+getMessage(item) + m + 
                        "</span></li>");
                list.append(iList);
            });
            var html = htmlspecialchars("<p>РусьЭнерго осуществляет:</p>" + resultText);
            resultTextId.html(html).append(list);
        },
        removeActiveNext: function (control, box) {
            if (box.next !== 'finish') {
                $(box.id + ' .btn_f').unbind();
            } else {
                $(this).off('submit');
                $(this).submit(function (e) {
                    e.preventDefault();
                });
            }
            $(box.id + ' .btn_f').addClass('blocked');
        },
        checkBuildCond: function (stat) {
            if (stat === 'add') {

            } else {

            }
        },
        renderBlock: function (items, control, box) {
            var controller = {
                items: {},
                stat: 'done'
            };
            var $this = $(this);
            var block = $this.find(box.id).addClass('is-active');
            var inputs = $('<div class="box_cont"></div>');
            /*	controller[box.name] = {
             items: {},
             stat: 'done'
             };*/
            $.each(items, function (i, item) {
                if (item.dict !== undefined) {
                    dictonary[item.name] = item.dict;
                } else {
                    dictonary[item.name] = item.title;
                }
                var cont = $('<div class="input_block"></div>');
                if (item.type !== 'checkbox')
                    controller.items[item.name] = undefined;
                //controller[box.name]['items'][item.name] = undefined;
                if (item.title) {
                    var title = $('<div class="zcb_name"><span>' + item.title + '</span></div>');
                    if (item.hint) {
                        title.append('<div class="hint"><i>?</i><span>' + item.hint + '</span></div>');
                    }
                }
                var node;
                if (item.dict !== undefined) {
                    dictonary[item.name] = item.dict;
                } else {
                    dictonary[item.name] = item.title;
                }
                switch (item.type) {
                    case "radio":
                    case "checkbox":
                        var inner = $('<div class="zc_block_two"><div class="pu_radio_list ' + item.type + '"></div><div>');
                        var list = inner.find('.pu_radio_list');
                        $.each(item.items, function (k, child) {
                            var label = $('<label><span>' + child.name + '</span></label>');
                            if (child.hint) {
                                label.append('<div class="hint"><i>?</i><span>' + child.hint + '</span></div>');
                            }
                            node = $('<input type="' + item.type + '" name="' + item.name + '" value="' + child.value + '" />');
                            label.prepend(node);
                            list.append(label);
                            if (item.type !== 'checkbox') {
                                node.change(function () {
                                    if (child.rate === true) {
                                        $('#' + rateId).calcRate();
                                    } else if (child.rate === false) {
                                        $('#' + rateId).calcRate('destroy');
                                    }
                                    controller.items[item.name] = $(this).val();
                                    collection[box.name].checkReady(controller);
                                });
                            }
                            if (child.dict !== undefined) {
                                dictonary[child.value] = child.dict;
                            } else {
                                dictonary[child.value] = child.name;
                            }
                        });
                        break;
                    case "text":
                        var inner = $('<div class="zcb_in_inner"><div class="zcb_in_title"></div></div>');
                        node = $('<input type="text" placeholder="' + item.placeholder + '" name="' + item.name + '"/>');
                        if (item.val === 'met')
                            node.addClass('met');
                        inner.find('.zcb_in_title').append(node);
                        if (item.rel === 'rate')
                            cont.attr('id', rateId);
                        node.on('keyup change', function () {
                            if (item.cond) {
                                checker = $('<div class="gaz_cond" id="' + item.cond.name + '"><label><input type="checkbox" name="build" value="y"/>Требуется строительство сети газораспределения</label></div>');
                                checker.find('label').append('<div class="hint"><i>?</i><span>' + item.cond.hint + '</span></div>');
                                checker.find('input').styler();
                                if ($(this).val() !== 0 && $(this).val() !== "") {
                                    if (item.cond.stat === 'hide') {
                                        item.cond.stat = 'show';
                                        inner.append(checker);
                                        //$this.calcForm('checkBuildCond', 'add');
                                    }
                                } else {
                                    if (item.cond.stat === 'show') {
                                        item.cond.stat = 'hide';
                                        $('#' + item.cond.name).remove();
                                        //$this.calcForm('checkBuildCond', 'rem');
                                    }
                                }
                            }
                            controller.items[item.name] = $(this).val();
                            collection[box.name].checkReady(controller);
                            //$('.zayavka_form').calcForm('setActiveNext', control, box);
                        });
                        break;
                }
                cont.append(title);
                cont.append(inner);
                inputs.append(cont);
            });
            var controlb = $('<div class="zayavka_send"></div>');
            switch (control.type) {
                case 'submit':
                    var but = $('<button type="submit" class="btn_f blocked">ОТПРАВИТЬ ЗАЯВКУ</button>');
                    break;
                case 'next':
                    var but = $('<a href="' + box.id + '" class="btn_f blocked">Далее</a>');
                    /*but.click(function(e){
                     e.preventDefault();
                     collection[control.next].show();
                     collection[box.name].hide();
                     active = control.next;
                     });*/
                    break;
            }
            controlb.append(but);
            inputs.append(controlb);
            block.append(inputs);
            //console.log(changeBlock);
            $this.find('.zcb_inputs').append(block);
        }
    };
    $.fn.calcForm = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Метод с именем ' + method + ' не существует для jQuery.tooltip');
        }

    };
})(jQuery);

var modelRate = {
    types:
            [
                {
                    name: 'Газовая плита',
                    item: 'Плита',
                    items:
                            [
                                {
                                    name: 'Конфорки',
                                    type: 'slider',
                                    min: 0,
                                    max: 4,
                                    value: 0.235,
                                    id: 1
                                },
                                {
                                    name: 'Духовые шкафы',
                                    type: 'slider',
                                    min: 0,
                                    max: 2,
                                    value: 0.235,
                                    id: 2
                                }
                            ]
                },
                {
                    name: 'Газовый котёл',
                    item: 'Котёл',
                    items:
                            [
                                {
                                    name: 'Площадь дома, кв. м',
                                    type: 'text',
                                    placeholder: 'Введите значение в кв. м',
                                    value: 0.0129,
                                    id: 3
                                }
                            ]
                }
            ]
};
(function ($) {

    var ItemCollection = function () {
        var Item = function () {
            this.id;
            this.sum = 0;
            this.values = {};
            this.addValue = function (id) {
                this.values[id] = 0;
            };
            this.setValue = function (id, value) {
                this.values[id] = parseFloat(value);
                this.setSum();
                $('#rateCalc').calcRate('setSum');
            };
            this.setSum = function () {
                this.sum = 0;
                for (var key in this.values) {
                    if (this.values[key] !== 0) {
                        //console.log(typeof parseFloat(this.values[key]));
                        //this.sum = parseFloat(this.sum);
                        //console.log(typeof this.sum);
                        this.sum += parseFloat(this.values[key]);
                    }
                }
            };
            this.getSum = function () {
                return (parseFloat(this.sum));
            };
        };
        this.allSum = 0;
        this.count = 1;
        this.items = {};
        this.addItem = function () {
            this.items[this.count] = new Item();
            return (this.count++);
        };
        this.getItem = function (id) {
            return this.items[id];
        };
        this.removeItem = function (id) {
            delete this.items[id];
            $('#rateCalc').calcRate('setSum');
        };
        this.getAllSum = function () {
            this.allSum = 0;
            for (var key in this.items) {
                this.allSum += this.items[key].getSum();
            }
            //console.log(this.allSum);
            return (Math.round(this.allSum * 100) / 100);
        };
    };
    var Collection = new ItemCollection();
    var settings = {
        div: $('<div id="rateCalc"></div>'),
        divItems: $('<div class="rate_items"></div>'),
        divId: "#rateCalc",
        elem: '',
        divInfo: $('<div class="gaz_sumblock"><p>Максимальный часовой расход газа:</p><p><span id="gaz_rate_sum"></span> куб. м</p></div>'),
        showCalc: $('<a class="gaz_rate_button active gaz_rate_show" href="#">Рассчитать МЧРГ</a>'),
        hideCalc: $('<a class="gaz_rate_button gaz_rate_hide" href="#">Скрыть калькулятор</a>'),
        titleCalc: 'Выберите оборудование, которое присутствует в вашем доме:'
    };
    var methods = {
        init: function () {
            var $this = $(this);
            settings.elem = $this;
            //$this.append(settings.hideCalc);
            settings.hideCalc.bind('click.calcRate', methods.hide);
            $this.append(settings.div);
            $this.calcRate('hide');
            settings.showCalc.bind('click.calcRate', methods.show);
            $this.find('.zcb_in_inner').append(settings.showCalc).append(settings.hideCalc);
            $this.calcRate('renderButton', modelRate.types);
            $(settings.divId).append(settings.divItems);
            //  $(settings.divId).append(settings.divInfo);
        },
        renderButton: function (blocks) {
            var $this = $(this);
            var list = $('<div class="gaz_rate_buttons"></div>');
            $.each(blocks, function (i, type) {
                $button = $('<button class="btn_gaz btn_gaz_small">' + type.name + '</button>');
                $button.bind('click.calcRate', {items: type.items, name: type.item}, methods.renderItem);
                list.append($button);
            });
            settings.div.append('<div class="gaz_rate_title">' + settings.titleCalc + '</div>');
            settings.div.append(list);
        },
        show: function () {
            settings.div.show(0);
            settings.showCalc.removeClass('active');
            settings.hideCalc.addClass('active');
            //settings.elem.find('.zcb_in_inner').hide(0);
            return false;
        },
        hide: function () {
            settings.div.hide(0);
            settings.showCalc.addClass('active');
            settings.hideCalc.removeClass('active');
            //settings.elem.find('.zcb_in_inner').show(0);
            return false;
        },
        renderItem: function (event) {
            //e.preventDefault();
            var id = Collection.addItem();
            var values = Collection.getItem(id);
            var block = $('<div class="gaz_rate_item"><h4>' + event.data.name + '</h4></div>');
            var delBlock = $('<a class="gaz_rate_item_delete" href="#">Удалить</a>');
            delBlock.click(function (e) {
                e.preventDefault();
                Collection.removeItem(id);
                block.remove();
            });
            block.append(delBlock);
            //console.log(arguments);
            $.each(event.data.items, function (i, item) {
                values.addValue(item.id);
                var inner = $('<div class="gaz_input"><div class="gaz_input_name">' + item.name + '</div></div>');
                var nodewrap = $('<div class="gaz_input_value"></div>');
                switch (item.type) {
                    case "text":
                        var node = $('<input class="met" type="text" placeholder="' + item.placeholder + '"/>');
                        $(node).on('keyup', function () {
                            values.setValue(item.id, parseFloat(this.value * item.value).toFixed(2));
                        });
                        break;
                    case "slider":
                        var node = $('<div class="gaz_slider"></div>');
                        node.slider({
                            max: item.max,
                            min: item.min,
                            step: 1,
                            change: function (event, ui) {
                                values.setValue(item.id, parseFloat(ui.value * item.value));
                            }
                        }).slider('pips', {
                            rest: "label"
                        });
                        break;
                }
                block.append(inner.append(nodewrap.append(node)));
            });
            settings.elem.find('.rate_items').append(block);
            //$("#gaz_rate_sum").html('1.5');
            return false;
        },
        setSum: function () {
            var sum = Collection.getAllSum();
            if (sum === 0)
                sum = "";
            $('input[name="rash"]').val(sum); // Сделать связку через родительский элемент
            $('input[name="rash"]').trigger('change');
        },
        destroy: function () {
            $(this).unbind('calcRate');
            $(this).find('.zcb_in_inner').show(0);
            settings.div.find('div').remove();
            settings.showCalc.remove();
            settings.hideCalc.remove();
            settings.div.remove();
            /*$(this).find('.gaz_rate_buttons').remove();
             $(this).find('.gaz_rate_item').remove();*/
        }
    };
    $.fn.calcRate = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Метод с именем ' + method + ' не существует для jQuery.tooltip');
        }
    };
})(jQuery);
$('.zayavka_form').calcForm();

function htmlspecialchars(html) {
    // Сначала необходимо заменить &
    html = html.replace(/&quot;/g, '');
    html = html.replace(/&lt;/g, '<');
    html = html.replace(/&gt;/g, '>');
    // Возвращаем полученное значение
    return html;
}