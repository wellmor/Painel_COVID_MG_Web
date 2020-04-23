import './Css/InfoView.scss';
import React from 'react';
import { Modal } from '../Layouts';

function InfoView(props) {
    const { isShow, onClickClose } = props;
    return (
        <Modal 
            extraClass="info-view" 
            extraContentClass="info-view__content has-text-centered"
            isShow={isShow} 
            onClickClose={onClickClose}
            >
            <div className="columns is-mobile">
                <div className="column">
                    <a href="#" target="_blank" rel="noopener noreferrer">Link</a>
                </div>
                <div className="column">
                    <a href="https://github.com/wellmor/COVID-19" target="_blank" rel="noopener noreferrer">Repositório Github</a>
                </div>
            </div>
            <p className="is-size-7">&copy; Corona Vírus</p>
        </Modal>
    );
}

export default InfoView;