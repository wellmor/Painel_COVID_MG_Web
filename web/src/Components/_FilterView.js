import './Css/FilterView.scss';
import React, { useState, useEffect } from 'react';
import { Modal } from '../Layouts';

function FilterView(props) {
    // Props, States
    const { 
        isShow, 
        isNeedReset, 
        locationArray, 
        onClickFilter, 
        onClickClose ,
        onResetEnd
    } = props;

    const [query, setQuery] = useState('');
    const [minConfirmed, setMinConfirmed] = useState(0);
    const [maxConfirmed, setMaxConfirmed] = useState(1000000);

    // Functions
    function onSubmitFilter() {
        const nextLocationArray = locationArray.map(location => {
            let nextLocation = Object.assign({}, {...location});
            const { 
                country, province,  
                latest: { confirmed } 
            } = nextLocation;

            const lcCountry = country.toLowerCase();
            const lcProvince = province.toLowerCase();
            const lcQuery = query.toLowerCase();

            const isContainsQuery = lcCountry.includes(lcQuery) || lcProvince.includes(lcQuery);
            const isInConfirmedRange = confirmed >= minConfirmed && confirmed <= maxConfirmed;

            const isAllPassed = isContainsQuery && isInConfirmedRange;

            if (isAllPassed) delete nextLocation.isHidden;
            else nextLocation.isHidden = true;

            return nextLocation;
        });
        onClickFilter(nextLocationArray);
    }

    // Effects
    useEffect(() => {
        if (isNeedReset) {
            setQuery('');
            setMinConfirmed(0);
            setMaxConfirmed(100000);
            onResetEnd();
        }
    }, [isNeedReset, onResetEnd]);

    return (
        <Modal
            extraClass="filter-view" 
            extraContentClass="filter-view__content"
            isShow={isShow} 
            onClickClose={onClickClose}>
            <form action="#">
                <h4 className="title is-4">Filtrar Cidades</h4>
                <label className="label">Buscar Cidade</label>
                <div className="field">
                    <div className="control is-expanded">
                        <input
                            className="input"
                            type="text"
                            placeholder="Pesquise a cidade."
                            value={query}
                            onChange={e => setQuery(e.target.value)} />
                    </div>
                </div>
                
                <div className="field is-grouped is-grouped-right">
                    <div className="control">
                        <button
                            className="button"
                            type="button"
                            onClick={onClickClose}>
                            Cancelar
                            </button>
                    </div>
                    <div className="control">
                        <button
                            className="button is-link"
                            type="submit"
                            onClick={onSubmitFilter}>
                            Filtro
                            </button>
                    </div>
                </div>
            </form>
        </Modal>
    )
}

export default FilterView;