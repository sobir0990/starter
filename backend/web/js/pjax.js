
$(document).ready(function () {
  let _registered = []

  window.reload_pjax = function (url, title = null, target = '#id_form_modal') {

    if (!title) {
      title = __t('Загрузка...')
    }

    $(target + ' .modal-header h5').html(title)

    $.pjax.reload(target + ' #id_pjax_container', {
      history: false,
      cache: false,
      push: false,
      timeout: 15000,
      url: url,
      replace: false
    })
  }

  let _register_click = function () {
    $('body').off('click.pjax').on('click.pjax', '[data-toggle="modal"][data-target="#id_form_modal"]', function () {
      window.pjax_element = $(this)

      let target = $(this).data('target')
      let url = $(this).data('content-url') || $(this).attr('href')

      let size = $(this).data('modal-size') || null
      let css_class = $(target).attr('class').replaceAll('fade',' ');
      css_class = css_class.replaceAll('fixed-block',' ');

      let extra_class = $(this).data('modal-class');

      if (extra_class) {
        css_class += ' ' + extra_class;
      } else {
        css_class += ' fade ';
      }


      $(target).attr('class', '');
      $(target).addClass(css_class);

      let md = $(target).find('.modal-dialog').removeClass('modal-xl').removeClass('modal-sm').removeClass('modal-lg')
      if (size) {
        md.addClass('modal-' + size)
      }

      var body = $(target).find('#id_pjax_container')
      body.html('<i class=\"fal fa-spinner font-16 fa-pulse\"></i>')

      reload_pjax(url, $(this).data('modal-title') ?? $(this).attr('title'), target)
    }).each(function () {
      var target = $(this).data('target')
      if (_registered.indexOf(target) !== -1) {
        return
      }

      _registered.push(target)
      $(target).on('hidden.bs.modal', function () {
        $(document).off('submit.pjax.dialog')
      })
    })
  }

  $(document).on('pjax:complete', function () {
    _register_click()
  })

  $(document).ajaxComplete(function () {
    _register_click()
  })

  _register_click()

  window.register_pjax_click = function () {
    _register_click()
  }

  window.close_form_dialog = function () {
    $('#id_form_modal').modal('hide')
  }
})
