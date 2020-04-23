import './Css/ErrorView.scss';
import React from 'react';

function ErrorView(props) {
    const { error, onClickClose } = props;

    let label = 'Algo deu errado, espere um momento'
    if (error === null) return null;
    else if (error.message === 'Erro de conexão') {
        label = 'Problema na conexão da API, por favor espere um pouco.'
    }

    return (
        <div className="error-view">
            <div className="notification is-danger">
                <button className="delete" onClick={onClickClose}></button>
                <p><b>Erro : </b>{label}</p>
            </div>
        </div>
    );
}

export default ErrorView;