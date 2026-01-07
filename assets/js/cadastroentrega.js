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

select.addEventListener("change", function () {
  const selectedOption = this.options[this.selectedIndex];
  const preco = selectedOption.getAttribute("data-preco") || "";
  caixaPreco.value = preco;
  atualizarPreco();
});

if (caixaQuant) {
  caixaQuant.addEventListener("input", function () {
    atualizarPreco();
  });
}

caixaPreco.addEventListener("input", function () {
  atualizarPreco();
});

caixaCusto.addEventListener("input", function () {
  if (!this.value) {
    this.value = 0;
  }
  atualizarPreco();
});

let servicos = [];

if (formServico) {
  formServico.addEventListener("submit", function (event) {
    event.preventDefault();

    const peca = this.peca.value;
    const preco = this.preco.value;
    const custo = this.custo.value;
    const quant = this.quantidade.value;

    if(servicos.find(servico => servico.peca == peca) !== undefined){
      msgErro.innerHTML = "Peça já registrada!";
      msgErro.style.color = 'red';
      msgErro.style.display = 'block';
    }else if (peca && preco && quant > 0) {
      servicos.push({
        peca,
        quant,
        preco,
        custo,
      });

      atualizarTabela();

      msgErro.style.display = "none";
      tabela.style.display = "block";
      divCheckPago.style.display = "block";

      inputServicos.value = JSON.stringify(servicos);

      this.reset();
    }
  });
}

function atualizarTabela() {
  const tbody = tabela.querySelector("tbody");
  tbody.innerHTML = '';

  console.log(servicos);
  servicos.forEach((servico) => {
    const linha = tbody.insertRow();
    linha.insertCell().textContent = formServico.peca.options[formServico.peca.selectedIndex].text;
    linha.insertCell().textContent = servico.quant;
    linha.insertCell().textContent = "R$" + servico.preco * servico.quant;
    linha.insertCell().textContent = "R$" + servico.custo;
    linha.insertCell().textContent =
      "R$" + (servico.preco * servico.quant - servico.custo);

    const botaoExcluir = document.createElement("button");
    botaoExcluir.type = "button";
    botaoExcluir.classList.add("btn", "btn-sm", "btn-danger");
    botaoExcluir.dataset.idPeca = servico.peca;
    botaoExcluir.onclick = () => {
    servicos = servicos.filter(
        servico => servico.peca != botaoExcluir.dataset.idPeca
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
    if (checkPago.checked) {
      inputDataPagamento.value =
        data.getFullYear() + "-" + (data.getMonth() + 1) + "-" + data.getDate();
    }
  });
}

if (inputDataEntrega) {
  inputDataEntrega.value =
    data.getFullYear() + "-" + (data.getMonth() + 1) + "-" + data.getDate();
}

if (textoPrecoTotal) {
  atualizarPreco();
}

dselect(select, {
  search: true,
});
