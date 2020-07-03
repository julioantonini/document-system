$(document).ready(function() {

  setMenu();
  setMenuMobile();
  setValidations();
  setDataTable();
  setMaskedInput();
  setDelete();
  setGetTipos();
  setGetTiposLoad();

  $(window).load(function() {

  });

});


function setMenu() {
  $('.menu-mobile').on('click', function(e) {
    e.preventDefault();
    $('.menu-container').slideToggle();

  });
}

function setMenuMobile() {
  $('.menu li').hover(function() {
    $('.menu-sub', $(this)).stop(true, true).slideDown();
  }, function() {
    $('.menu-sub', $(this)).stop(true, true).slideUp();
  });
}



function setValidations() {

  $('#form_cad_usuario').validate({
    rules: {
      nome: {
        required: true
      },
      email: {
        required: true,
        email: true
      },
      senha: {
        required: true,
        minlength: 6
      },
    },
    messages: {
      nome: {
        required: 'Este campo é obrigatório'
      },
      email: {
        required: 'Este campo é obrigatório',
        email: 'Este não parece ser um e-mail válido'
      },
      senha: {
        required: 'Este campo é obrigatórioo',
        minlength: 'Este campo deve ter no minimo 6 caracteres'
      },
      mensagem: {
        required: 'Este campo é obrigatório'
      },
    },
  });


  $('#form_cad_cliente').validate({
    rules: {
      empresa: {
        required: true
      },
      cnpj: {
        required: true
      },
      status: {
        required: true,
      },
    },
    messages: {
      empresa: {
        required: 'Este campo é obrigatório'
      },
      cnpj: {
        required: 'Este campo é obrigatórioo'
      },
      status: {
        required: 'Este campo é obrigatório'
      },
    },
  });


  $('#form_cad_funcionario').validate({
    rules: {
      empresa: {
        required: true
      },
      nome: {
        required: true
      },
      email: {
        required: true,
        email: true
      },
      status: {
        required: true
      },
      senha: {
        required: true,
        minlength: 6
      },
    },
    messages: {
      empresa: {
        required: 'Este campo é obrigatório'
      },
      nome: {
        required: 'Este campo é obrigatório'
      },
      email: {
        required: 'Este campo é obrigatório',
        email: 'Este não parece ser um e-mail válido'
      },
      status: {
        required: 'Este campo é obrigatório'
      },
      senha: {
        required: 'Este campo é obrigatórioo',
        minlength: 'Este campo deve ter no minimo 6 caracteres'
      },
      mensagem: {
        required: 'Este campo é obrigatório'
      },
    },
  });


  $('#form_cad_documento').validate({
    rules: {
      cliente: {
        required: true
      },
      categoria: {
        required: true
      },
      tipo: {
        required: true
      },
      nome: {
        required: true
      },
    },
    messages: {
      cliente: {
        required: 'Este campo é obrigatório'
      },
      categoria: {
        required: 'Este campo é obrigatório'
      },
      tipo: {
        required: 'Este campo é obrigatório'
      },
      nome: {
        required: 'Este campo é obrigatório'
      },
    },
  });


  $('#form_altera_senha').validate({
    rules: {
      senha: {
        required: true
      },
      novasenha: {
        required: true,
        minlength: 6
      },
      novasenha2: {
        required: true,
        equalTo: '#novasenha'
      },
    },
    messages: {
      senha: {
        required: 'Este campo é obrigatório'
      },
      novasenha: {
        required: 'Este campo é obrigatório',
        minlength: 'Este campo deve ter no minimo 6 caracteres'
      },
      novasenha2: {
        required: 'Este campo é obrigatório',
        equalTo: 'A nova senha não confere'
      },
    },
  });


  $('#frm_select_empresas').validate({
    rules: {
      empresa: {
        required: true
      },
    },
    messages: {
      empresa: {
        required: 'Este campo é obrigatórioo'
      }
    },
  });

  $('#form_login').validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      senha: {
        required: true
      }
    },
    messages: {
      email: {
        required: 'Este campo é obrigatório',
        email: 'Este não parece ser um e-mail válido'
      },
      senha: {
        required: 'Este campo é obrigatórioo'
      }
    },
  });

}



function setDataTable() {
  $('.tbl-data').DataTable({
    "aaSorting": [],
    responsive: true,
    responsive: {
      details: false
    },
    columnDefs: [{
      targets: 'no-sort',
      orderable: false
    }],
    "oLanguage": {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Exibindo de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Exibindo 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }

  });
}


function setMaskedInput() {
  $(".date").mask("99/99/9999", {
    placeholder: " "
  });
  $(".celnumber").mask("(99) 9999-9999?9");
  $(".phonenumber").mask("(99) 9999-9999");
  $(".hora").mask("99:99");
  $(".cpf").mask("999.999.999-99");
  $(".cep").mask("99999-999");
  $(".cnpj").mask("99.999.999/9999-99");
}





function getEndereco() {
  if ($.trim($('#cep').val()) != "") {
    $('#endereco').val("carregando");
    $('#bairro').val("carregando");
    $('#cidade').val("carregando");
    $('#estado').val("selecione");
    $('#endereco').attr('disabled', true);
    $('#bairro').attr('disabled', true);
    $('#cidade').attr('disabled', true);
    $('#estado').attr('disabled', true);
    $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep=" + $("#cep").val(), function() {
      $('#endereco').removeAttr('disabled');
      $('#bairro').removeAttr('disabled');
      $('#cidade').removeAttr('disabled');
      $('#estado').removeAttr('disabled');
      if ((resultadoCEP["resultado"] == 1) || (resultadoCEP["resultado"] == 2)) {
        var rua = unescape(resultadoCEP["tipo_logradouro"]) + ": " + unescape(resultadoCEP["logradouro"])
        if (rua == ": ") {
          $('#endereco')
            .val("");
        } else {
          $('#endereco').val(rua);
        }
        $('#bairro').val(unescape(resultadoCEP["bairro"]));
        $('#cidade').val(unescape(resultadoCEP["cidade"]));
        $('#estado').val(unescape(resultadoCEP["uf"]));

      } else if (resultadoCEP["resultado"] == 0) {
        $('#endereco').val("");
        $('#bairro').val("");
        $('#cidade').val("");
        $('#estado').val("");
        $('#endereco').focus();
      }
    });
  }
}


function setDelete() {
  $('.btn-delete').on('click', function(e) {
    e.preventDefault();
    var href = $(this).attr("href");
    swal({
      title: 'ATENÇÃO',
      text: "Deseja realmente excluir?",
      type: 'error',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false
    }).then(function() {
      window.location.href = href;
    }, function(dismiss) {

    })


  });
}




function setGetTipos() {
  $('#select-categoria').on('change', function() {
    var categoria = $(this).val();
    $('#tipo_documento').attr('disabled', true);
    var base_url = $('#base_url').val();
    $("#tipo_documento").html('<option value="">Carregando...</option>');
    $.post(base_url + '/documento/get_tipos/' + categoria, function(data) {
      $('#tipo_documento').removeAttr('disabled');
      $('#tipo_documento').html(data);
    });
  });
}


function setGetTiposLoad() {
  var categoria = $('#select-categoria').val();
  $('#tipo_documento').attr('disabled', true);
  var base_url = $('#base_url').val();
  $("#tipo_documento").html('<option value="">Carregando...</option>');
  $.post(base_url + '/documento/get_tipos/' + categoria, function(data) {
    $('#tipo_documento').removeAttr('disabled');
    $('#tipo_documento').html(data);
  });
}
