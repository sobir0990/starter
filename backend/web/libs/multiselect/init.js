'use strict';
var lang = $('html').attr('lang');
$('.multiple-select').multipleSelect({
    filterByDataLength: 99999,
    position: 'bottom',
    dropWidth: '100%',
    filter: true,
    maxHeight: 200,
    selectAll: true,
    minimumCountSelected: 2,
    formatSelectAll() {
        return lang == 'ru' ? 'Выбрать все' : (lang == 'ru' ? 'Барчасини танлаш' : 'Barchasini tanlash')
    },
    formatAllSelected() {
        return lang == 'ru' ? 'Выбрано все' : (lang == 'ru' ? 'Барчасини танланган' : 'Barchasini tanlangan')
    },
    formatCountSelected(count, total) {
        return lang == 'ru' ? __t(`Выбрано {0} из {1}`, [count, total]) :
            (lang == 'ru' ? __t(`{1} тадан {0} таси танланган`, [count, total]) : __t('{1} tadan {0} tasi tanlangan', [count, total]))
    },
    formatNoMatchesFound() {
        return lang == 'ru' ? 'Нет результатов' : (lang == 'ru' ? 'Маълумот топилмади' : `Ma'lumot topilmadi`)
    }
})


