// version 0.5
// documentの方が複雑すぎるため修正必須
// cssからスタイルを引っ張ってくるより
// こちらで指定してしまったほうが良いかも
"use strict";
// 部屋データ(仮)
let list = [
    { name: 'A-1', state: true },
    { name: 'A-2', state: true },
    { name: 'A-3', state: true },
    { name: 'A-4', state: true },
    { name: 'A-5', state: false },
    { name: 'A-6', state: true },
    { name: 'A-7', state: false },
    { name: 'A-8', state: true },
    { name: 'B-1', state: true },
    { name: 'B-2', state: true },
    { name: 'B-3', state: false },
    { name: 'B-4', state: true },
    { name: 'B-5', state: true },
    { name: 'B-6', state: true },
    { name: 'B-7', state: false },
    { name: 'B-8', state: true },
    { name: 'C-1', state: true },
    { name: 'C-2', state: false },
    { name: 'C-3', state: true },
    { name: 'C-4', state: true },
    { name: 'C-5', state: true },
    { name: 'C-6', state: true },
    { name: 'C-7', state: false },
    { name: 'C-8', state: true },
    { name: 'D-1', state: true },
    { name: 'D-2', state: true },
    { name: 'D-3', state: true },
    { name: 'D-4', state: true },
    { name: 'D-5', state: false },
    { name: 'D-6', state: true },
    { name: 'D-7', state: true },
    { name: 'D-8', state: true },
    { name: 'E-1', state: true },
    { name: 'E-2', state: true },
    { name: 'E-3', state: false },
    { name: 'E-4', state: true },
    { name: 'E-5', state: false },
    { name: 'E-6', state: true },
    { name: 'E-7', state: true },
    { name: 'E-8', state: true },
    { name: 'F-1', state: false },
    { name: 'F-2', state: true },
    { name: 'F-3', state: true },
    { name: 'F-4', state: true },
    { name: 'F-5', state: true },
    { name: 'F-6', state: true },
    { name: 'F-7', state: false },
    { name: 'F-8', state: true },
];
let list2 = [
    [
        { type: 0, text: '' },
        { type: 2, text: '' },
        { type: 2, text: 'ス' },
        { type: 2, text: 'ク' },
        { type: 2, text: 'リ' },
        { type: 2, text: 'ー' },
        { type: 2, text: 'ン' },
        { type: 2, text: '' },
        { type: 2, text: '' },
        { type: 0, text: '' },
    ],
    [
        { type: 0, text: '' },
        { type: 0, text: '1' },
        { type: 0, text: '2' },
        { type: 0, text: '3' },
        { type: 0, text: '4' },
        { type: 0, text: '5' },
        { type: 0, text: '6' },
        { type: 0, text: '7' },
        { type: 0, text: '8' },
        { type: 0, text: '' },
    ],
    [
        { type: 0, text: 'A' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 0, text: 'A' },
    ],
    [
        { type: 0, text: 'B' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 0, text: 'B' },
    ],
    [
        { type: 0, text: 'C' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 0, text: 'C' },
    ],
    [
        { type: 0, text: '' },
        { type: 0, text: '' },
        { type: 0, text: '' },
        { type: 0, text: '' },
        { type: 0, text: '' },
        { type: 0, text: '' },
        { type: 0, text: '' },
        { type: 0, text: '' },
        { type: 0, text: '' },
        { type: 0, text: '' },
    ],
    [
        { type: 0, text: 'D' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 0, text: 'D' },
    ],
    [
        { type: 0, text: 'E' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 0, text: 'E' },
    ],
    [
        { type: 0, text: 'F' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 1, text: '' },
        { type: 0, text: 'F' },
    ],

];
// form用script
// 部屋データを直接取得しているため注意 list list2
(function () {
    new Vue({
        el: '#app',
        data: {
            outputData: [],
            roomData: [], // いらないかも
            inputData: []
        },
        methods: {
            action: function (index) {
                let data = this.outputData[index];
                // console.log(index);
                if (!data.name) return;
                data.select = !data.select;
                data.classObj['seat-form__serected'] = data.select;
                if (data.select) {
                    this.inputData.push(data.name);
                } else {
                    this.inputData = this.inputData.filter(item => item !== data.name)
                }
                // console.log(data.name)
            },
            length: function (array) {
                return array.length
            }
        },
        created: function () {
            this.roomData = list2;

            list2.forEach((a) => {
                // console.log(a)
                a.forEach((element) => {
                    let obj = {
                        classObj: {
                        },
                        select: false,
                    }
                    switch (element.type) {
                        case 0:
                            obj.classObj['seat-form__state'] = true;
                            break;
                        case 1:
                            let seatData = list.shift();
                            // console.log(seatData.name)
                            if (seatData['state']) {
                                obj.classObj['seat-form__state--available'] = true;
                                obj.classObj['seat-form__serected'] = false;
                                obj.name = seatData.name;
                            } else {
                                obj.classObj['seat-form__state--unavailable'] = true;
                            }
                            break;
                        case 2:
                            obj.classObj['seat-form__state--black'] = true;
                            break;
                        default:
                            break;
                    }
                    obj.text = element.text;
                    this.outputData.push(obj);
                });
            });
        }
    });
})();
list = '';
list2 = '';