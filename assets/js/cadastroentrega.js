const selectCliente = document.getElementById('cliente');

const select = document.getElementById("selectPeca");
const caixaPreco = document.getElementById("preco");
const caixaCusto = document.getElementById("custo");
const caixaQuant = document.getElementById("quant");

const formServico = document.getElementById("formServico");
const msgErro = document.getElementById("msgErro");

const formFinal = document.getElementById("formFinal");
const inputServicos = document.getElementById("servicosJson");
const inputDataEntrega = document.getElementById("dataEntrega");
const inputDataPagamento = document.getElementById("dataPagamento");

const divCheckPago = document.getElementById("divCheckPago");
const checkPago = document.getElementById("checkPago");

const data = new Date();

const textoPrecoTotal = document.getElementById("precoTotal");
const labelLucro = document.getElementById("labelLucro");
const textoLucro = document.getElementById("lucro");

const tabela = document.getElementById("tabela");

if (textoPrecoTotal) {
  function atualizarPreco() {
    let precoTotal = caixaPreco.value * caixaQuant.value;
    let lucro = precoTotal - caixaCusto.value;

    if (precoTotal == 0) {
      textoPrecoTotal.innerHTML = "não definido";
      textoLucro.innerHTML = "não definido";
      labelLucro.style.color = "";
      textoLucro.style.color = "";
    } else {
      textoPrecoTotal.innerHTML = "R$" + precoTotal;
      textoLucro.innerHTML = "R$" + lucro;
      labelLucro.style.color = "green";
      textoLucro.style.color = "green";
    }
  }
}

if(select){
  select.addEventListener("change", function () {
    const selectedOption = this.options[this.selectedIndex];
    const preco = selectedOption.getAttribute("data-preco") || "";
    caixaPreco.value = preco;
    atualizarPreco();
  });
}

if (caixaQuant) {
    mascaraPreco('quant');
  caixaQuant.addEventListener("input", function () {
    atualizarPreco();
  });
}

if(caixaPreco){
  mascaraPreco('preco');
  caixaPreco.addEventListener("input", function () {
    atualizarPreco();
  });
}

if(caixaCusto){
  mascaraPreco('custo');
  caixaCusto.addEventListener("change", function () {
    if (!this.value) {
      this.value = 0;
    }
    atualizarPreco();
  });
}

if(selectCliente){
  selectCliente.addEventListener('change', function(){
    document.getElementById('formCliente').requestSubmit();
  })
}

let servicos = [];

if (formServico) {
  formServico.addEventListener("submit", function (event) {
    event.preventDefault();

    const idPeca = this.peca.value;
    const nomePeca = formServico.peca.options[formServico.peca.selectedIndex].text;
    const preco = this.preco.value;
    const custo = this.custo.value;
    const quant = this.quantidade.value;

    if(servicos.find(servico => servico.idPeca == idPeca) !== undefined){
      msgErro.innerHTML = "Peça já registrada!";
      msgErro.style.color = 'red';
      msgErro.style.display = 'block';
    }else if (idPeca && preco && quant > 0) {
      servicos.push({
        idPeca,
        nomePeca,
        quant,
        preco,
        custo,
      });

      atualizarTabela();

      //Tirar mensagem de erro
      msgErro.style.display = "none";
      tabela.style.display = "block";
      divCheckPago.style.display = "block";

      inputServicos.value = JSON.stringify(servicos);

      this.reset();

      //Tira a seleção dos elementos do select
      Array.from(this.getElementsByClassName('dselect-items')[0].children).forEach((element, index) => {element.classList.remove('active')});

      //Troca o texto do dselect pelo valor do primeiro valor do select original
      this.getElementsByClassName('dselect-wrapper')[0].children[0].innerHTML = select.children[0].innerHTML;
    }
  });
}

function atualizarTabela() {
  const tbody = tabela.querySelector("tbody");
  tbody.innerHTML = '';

  servicos.forEach((servico) => {
    const linha = tbody.insertRow();
    linha.insertCell().textContent = servico.nomePeca;
    linha.insertCell().textContent = servico.quant;
    linha.insertCell().textContent = "R$" + servico.preco * servico.quant;
    linha.insertCell().textContent = "R$" + servico.custo;
    linha.insertCell().textContent = "R$" + (servico.preco * servico.quant - servico.custo);

    //Criar botão de excluir
    const botaoExcluir = document.createElement("button");
    botaoExcluir.type = "button";
    botaoExcluir.classList.add("btn", "btn-sm", "btn-danger");
    botaoExcluir.dataset.idPeca = servico.idPeca;
    botaoExcluir.onclick = () => {
    servicos = servicos.filter(
        servico => servico.idPeca != botaoExcluir.dataset.idPeca
      );
      atualizarTabela();
    };

    const icone = document.createElement("i");
    icone.classList.add("bi", "bi-trash");
    botaoExcluir.appendChild(icone);

    linha.insertCell().appendChild(botaoExcluir);
  });
}

if (formFinal) {
  formFinal.addEventListener("submit", function () {
    //Remover nome das peças dos serviços (inútil pro backend)
    servicos.forEach(servico => {
      if(nomePeca in servico) delete servico.nomePeca;
    })
    if (checkPago.checked) {
      inputDataPagamento.value =
        data.getFullYear() + "-" + (data.getMonth() + 1) + "-" + data.getDate();
    }
  });
}

if (textoPrecoTotal) {
  atualizarPreco();
}

if(select){
  dselect(select, {
    search: true,
  });
}

dselect(document.getElementById('cliente'), {
  search: true
});