export function formatStatusBet(statusBet) {
    switch (String(statusBet)) {
        case '0': return `Em andamento`;
        case '1': return `Anulada`;
        case '2': return `Cash Out`;
        case '3': return `Erro`;
        case '4': return `Acerto`;
        default: return statusBet;
    }
}

export function formatCurrencyBRL(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

export function formatDate(date) {
    const d = new Date(date);

    const day = String(d.getDate()).padStart(2, '0');
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const year = d.getFullYear();

    return `${day}/${month}/${year}`;
}
