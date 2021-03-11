// version 0.5
// documentの方が複雑すぎるため修正必須
// cssからスタイルを引っ張ってくるより
// こちらで指定してしまったほうが良いかも
"use strict";
// 部屋データ(仮)
// let list = [
//     { name: 'A-1', state: true },
//     { name: 'A-2', state: true },
//     { name: 'A-3', state: true },
//     { name: 'A-4', state: true },
//     { name: 'A-5', state: false },
//     { name: 'A-6', state: true },
//     { name: 'A-7', state: false },
//     { name: 'A-8', state: true },
// ];
// let list2 = [
//     [
//         { type: 0, text: '' },
//         { type: 2, text: '' },
//         { type: 2, text: 'ス' },
//         { type: 2, text: 'ク' },
//         { type: 2, text: 'リ' },
//         { type: 2, text: 'ー' },
//         { type: 2, text: 'ン' },
//         { type: 2, text: '' },
//         { type: 2, text: '' },
//         { type: 0, text: '' },
//     ],
//     [
//         { type: 0, text: '' },
//         { type: 0, text: '1' },
//         { type: 0, text: '2' },
//         { type: 0, text: '3' },
//         { type: 0, text: '4' },
//         { type: 0, text: '5' },
//         { type: 0, text: '6' },
//         { type: 0, text: '7' },
//         { type: 0, text: '8' },
//         { type: 0, text: '' },
//     ],
//     [
//         { type: 0, text: 'A' },
//         { type: 1, text: '' },
//         { type: 1, text: '' },
//         { type: 1, text: '' },
//         { type: 1, text: '' },
//         { type: 1, text: '' },
//         { type: 1, text: '' },
//         { type: 1, text: '' },
//         { type: 1, text: '' },
//         { type: 0, text: 'A' },
//     ],
// ];
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