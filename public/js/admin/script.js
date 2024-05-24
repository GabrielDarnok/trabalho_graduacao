// Config para iniciar os pop ups
$(document).ready(function(){
    $('#meuModal').modal('show');
});
$(document).ready(function(){
    $('.close').click(function(){
      $('#meuModal').modal('hide');
    });
});

var productIdToDelete; // Variável para armazenar o ID do produto a ser excluído

// Função para capturar o ID do produto quando o modal é mostrado
$('#confirmarExcluir').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botão que acionou o modal
    productIdToDelete = button.data('product-id'); // Obtém o ID do produto do atributo data-product-id do botão
});

// Função para submeter o formulário de exclusão quando o botão "Excluir" é clicado
$('#confirmarExclusaoBtn').on('click', function () {
    // Se productIdToDelete for definido (ou seja, se um botão de exclusão foi clicado)
    if (productIdToDelete) {
        $('#deleteForm' + productIdToDelete).submit(); // Submete o formulário correspondente ao produto
    }
});

// Config para iniciar a tabela
$(document).ready(function () {
    $(".data-table").each(function (_, table) {
        $(table).DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
            }
        });
    });
});


//
$(document).ready(function() {
    // Verifica se há um botão previamente selecionado no armazenamento local
    var selectedButton = localStorage.getItem('selectedButton');
    if (selectedButton) {
        // Adiciona a classe 'active' ao botão previamente selecionado
        $('.nav-link[href="' + selectedButton + '"]').addClass('active');
        // Caso o botão esteja dentro de um collapse, também adiciona a classe 'active' ao botão principal
        if ($('.collapse').find('.nav-link[href="' + selectedButton + '"]').length > 0) {
            $('.collapse').find('.nav-link[href="' + selectedButton + '"]').closest('.collapse').prev('.nav-link').addClass('active');
            // Mantém o estado do collapse
            $('#layouts').addClass('show'); // Exibe o collapse pai
        }
    }

    // Adiciona a classe 'active' ao clicar em um link de navegação
    $('.nav-link').click(function(e) {
        var $this = $(this);
        var link = $this.attr('href');

        // Remove a classe 'active' de todos os links de navegação
        $('.nav-link').removeClass('active');
        // Adiciona a classe 'active' ao link clicado
        $this.addClass('active');

        // Armazena o link clicado no armazenamento local
        localStorage.setItem('selectedButton', link);

        // Armazena o estado do collapse
        var isCollapsed = $this.hasClass('sidebar-link') && $this.attr('data-bs-toggle') === 'collapse';
        if (isCollapsed) {
            var isCollapsedNow = $this.attr('aria-expanded') === 'true'; // Verifica se o collapse está aberto ou fechado
            localStorage.setItem('isLayoutsOpen', isCollapsedNow ? 'true' : 'false');
        } else {
            // Segue o link apenas se não for um item com collapse
            window.location.href = link;
        }

        // Verifica se o link clicado é um subitem e remove a classe 'active' do item principal
        if ($this.hasClass('sub-item')) {
            $('.sidebar-link').removeClass('active');
        }

        e.preventDefault(); // Previne o comportamento padrão do link para itens com collapse
    });

    // Armazena o estado do elemento collapse quando ele é aberto ou fechado
    $('#layouts').on('show.bs.collapse', function() {
        localStorage.setItem('isLayoutsOpen', 'true');
    }).on('hide.bs.collapse', function() {
        localStorage.setItem('isLayoutsOpen', 'false');
    });

    // Verifica o estado do collapse ao carregar a página
    var isLayoutsOpen = localStorage.getItem('isLayoutsOpen');
    if (isLayoutsOpen === 'true') {
        $('#layouts').addClass('show');
    }

});





