// Dicionário de cores acessíveis por tipo de daltonismo:
// Cada modo possui a tradução RGB das suas cores originais e o destino acessível correspondente.
const DicionárioAcessível = {
    "PP": {
        "#92E2F1": { rgb: "rgb(146, 226, 241)", substituta: "#0072B2" }, // Protanopia e Protanomalia
        "#45CDE8": { rgb: "rgb(69, 205, 232)", substituta: "#0072B2" },
        "#F23A84": { rgb: "rgb(242, 58, 132)",  substituta: "#009E73" }  
    },
    "DD": {
        "#92E2F1": { rgb: "rgb(146, 226, 241)", substituta: "#56B4E9" }, // Deuteranopia e Deuteranomalia
        "#45CDE8": { rgb: "rgb(69, 205, 232)", substituta: "#36454F" },
        "#F23A84": { rgb: "rgb(242, 58, 132)",  substituta: "#D55E00" }
    },
    "TT": {
        "#92E2F1": { rgb: "rgb(146, 226, 241)", substituta: "#005F73" }, // Tritanopia e Tritanomalia
        "#45CDE8": { rgb: "rgb(69, 205, 232)", substituta: "#252525" },
        "#F23A84": { rgb: "rgb(242, 58, 132)",  substituta: "#F5CB5C" }
    },
    "A": {
        "#92E2F1": { rgb: "rgb(146, 226, 241)", substituta: "#A0A0A0" }, // Acromatopsia (Monocromático / Tons de Cinza)
        "#45CDE8": { rgb: "rgb(69, 205, 232)", substituta: "#777777" },
        "#F23A84": { rgb: "rgb(242, 58, 132)",  substituta: "#4A4A4A" }
    }
};

function AplicarFiltroInvertido() {
    const InvertAccessibility = localStorage.getItem('InvertAccessibility');
    if (document.body.style.filter === "invert(100%)") {
        document.body.style.filter = "invert(0%)";
        document.body.style.backgroundColor = "white";
        localStorage.setItem('InvertAccessibility', 'false');
    } else {
        document.body.style.filter = "invert(100%)";
        document.body.style.backgroundColor = "black";
        localStorage.setItem('InvertAccessibility', 'true');
    }
}

function MudarCordoSiteparaAcessível() {
    const CB = document.getElementById('ComboBoxAcessibilidade');
    if (!CB) return;
    const SeleçãoAtual = CB.value;
    localStorage.setItem("Accessibility", SeleçãoAtual);

    // Se o valor que o usuário colocou for um valor que corresponde à pessoa normal, então atualiza a página para aplicar efeito normal.
    if (SeleçãoAtual === "...") {
        window.location.reload();
        return;
    }
    
    AplicarCorAcessível(SeleçãoAtual);
    window.location.reload();
}

// Função que varre a árvore do DOM e injeta os estilos acessíveis.
function AplicarCorAcessível(modo) {
    const MapadeCores = DicionárioAcessível[modo];
    if (!MapadeCores) return; // Caso o modo não exista no mapa, aborta

    const TodososElementos = document.querySelectorAll('*');

    TodososElementos.forEach(elemento => {
        const EstiloComputado = window.getComputedStyle(elemento);
        const ForeColor = EstiloComputado.color;
        const BackColor = EstiloComputado.backgroundColor;

        // Verifica cada cor configurada para o modo atual.
        Object.values(MapadeCores).forEach(config => {
            if (ForeColor === config.rgb) {
                elemento.style.color = config.substituta;
            }
            if (BackColor === config.rgb) {
                elemento.style.backgroundColor = config.substituta;
            }
        });
    });
}

// Aplica automaticamente o filtro de acessibilidade ao carregar qualquer página do site.
document.addEventListener("DOMContentLoaded", () => {
    const SavedAccessibility = localStorage.getItem('Accessibility');
    const CB = document.getElementById('ComboBoxAcessibilidade');

    if (SavedAccessibility && SavedAccessibility !== "...") {
        // Sincroniza visualmente o <select> com o valor guardado no navegador.
        if (CB) CB.value = SavedAccessibility;
        
        // Executa a alteração das cores imediatamente.
        AplicarCorAcessível(SavedAccessibility);
    }
});

document.body.addEventListener("a", () => {
    const SavedAccessibility = localStorage.getItem('InvertAccessibility');
    if (SavedAccessibility) {
        document.body.style.filter = "invert(100%)";
        document.body.style.backgroundColor = "black";
    } else {
        document.body.style.filter = "invert(0%)";
        document.body.style.backgroundColor = "white";
    }
});