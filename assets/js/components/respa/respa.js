import React from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';
import Select from 'react-select';
import DOMPurify from 'dompurify';


// Parent component
class Respa extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            items: [], // all items
            filteredItems: [], // items with filters applied
            itemsLoading: 0,
            language: '',
            selectedPurposeOptions: [],
            purposeOptions: [
                { value: 'photo-and-audio', label: 'Kuvaa tai ääntä' },
                { value: 'manufacturing', label: 'Valmistaa esineitä, askarrella tai korjata' },
                { value: 'meetings-and-working', label: 'Pitää kokouksen tai työskennellä' },
                { value: 'sports', label: 'Liikkua tai pelata'},
                { value: 'guidance', label: 'Opastus'}
            ],
            selectedCapacityOption: null,
            capacityOptions: [
                { value: 1, label: '1' },
                { value: 2, label: '2' },
                { value: 5, label: '5' },
                { value: 10, label: '10' },
                { value: 15, label: '15' },
                { value: 30, label: '30+' },
            ]
        };

        this.loadSpaces = this.loadSpaces.bind(this);
        this.formatTimestamp = this.formatTimestamp.bind(this);
        this.updateSpaces = this.updateSpaces.bind(this);
        this.setLanguage = this.setLanguage.bind(this);
        this.truncateString = this.truncateString.bind(this);
        this.handleCapacityOptionChange = this.handleCapacityOptionChange.bind(this);
        this.handlePurposeOptionChange = this.handlePurposeOptionChange.bind(this);
        this.resetFilters = this.resetFilters.bind(this);
        this.createMarkup = this.createMarkup.bind(this);
        this.getParameterByName = this.getParameterByName.bind(this);
        this.setPurposeFilterFromURLParams = this.setPurposeFilterFromURLParams.bind(this);
    }

    componentWillMount() {
        this.setLanguage();
        this.loadSpaces();
    }

    handleCapacityOptionChange(selectedCapacityOption) {
        this.setState({ selectedCapacityOption }, () => { this.updateSpaces(); });
    }

    handlePurposeOptionChange(selectedPurposeOptions) {
        this.setState({ selectedPurposeOptions }, () => { this.updateSpaces(); });
    }

    setLanguage() {
        let lang = document.documentElement.dataset.wpml;
        if (lang == '') {
            lang = 'fi';
        }
        this.setState( { language: lang } );
    }

    formatTimestamp(dateTimeString, format) {
        let dateTime = moment(dateTimeString);
        if ( dateTime.isValid() === false ) {
            return '';
        }
        return dateTime.format(format);
    }

    loadSpaces() {
        if ( ! this.state.itemsLoading ) {
            this.setState( { itemsLoading : 1 } );

            $.get('/wp-json/respa/v1/spaces', function(json) {
                this.setState({
                    items : json,
                });
                this.setState( { itemsLoading : 2 }, () => {
                    this.updateSpaces();
                    this.setPurposeFilterFromURLParams();
                });
            }.bind(this));
        }
    }

    /**
     * Sets a purpose filter based on passed URL params.
     * @returns {Return Type} Return description.
     */
    setPurposeFilterFromURLParams() {
        // Parameter used (or null if no parameter)
        let spaceParam = this.getParameterByName('space_purpose');

        if (spaceParam !== null) {
            // Find the option based on the parameter
            let found = this.state.purposeOptions.find(function(element) {
                return element.value === spaceParam;
            });

            // Use it to pass it as the selected option
            if (found) {
                this.setState({ selectedPurposeOptions: [...this.state.selectedPurposeOptions, found ] }, () => { this.updateSpaces(); });
            }
        }
    }

    /**
     * Get and purify (sanitize) content passed through PHP via JS globals.
     * Hacky, but more convenient than setting up an API just for these few strings.
     */
    createMarkup() {
        const content = DOMPurify.sanitize(window.respaBlockContent);
        return {__html: content};
    }

    /**
     * Get a query parameter by name (and optionally url).
     * TODO: Move to some kind of global helpers.
     */
    getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    updateSpaces() {
        let _this = this;

        // If nothin has been filtered out, return all items
        if (this.state.selectedCapacityOption == null && this.state.selectedPurposeOptions == null) {
            this.setState({
                filteredItems: this.state.items
            });
        // If any filter is selected
        } else {
            this.setState({ filteredItems: _this.state.items.filter(function (item) {
                let capacityFilter = true;
                let purposeFilter = true;

                // If no capacity filter has been selected, everything goes
                if (_this.state.selectedCapacityOption == null) {
                    capacityFilter = true;
                } else {
                    capacityFilter = (item.meta.people_capacity >= _this.state.selectedCapacityOption.value) ? true : false;
                }

                // If no purpose option is selected
                if (_this.state.selectedPurposeOptions.length === 0) {
                    purposeFilter = true;
                } else {
                   purposeFilter = false;
                    item.meta.purposes.forEach(function(item) {
                        _this.state.selectedPurposeOptions.forEach(function(option) {
                            if( item.id === option.value ){
                                purposeFilter = true;
                            }
                        });
                    });
                }

                return capacityFilter && purposeFilter;
            })});
        }
    }

    truncateString(string) {
        if (string.length <= 250) { return string; }
        let subString = string.substr(0, 250-1);
        return subString.substr(0, subString.lastIndexOf(' '));
     }


    resetFilters(e) {
        e.preventDefault();
        this.setState({ selectedPurposeOptions: [], selectedCapacityOption: null }, () => { this.updateSpaces(); });
    }

    render() {
        // const customStyles = {
        //     option: (base, state) => ({
        //         ...base,
        //         borderBottom: '1px dotted pink',
        //         color: state.isFullscreen ? 'red' : 'blue',
        //         padding: 20,
        //     }),
        //     control: () => ({
        //         // none of react-selects styles are passed to <View />
        //         width: 200,
        //     }),
        //     singleValue: (base, state) => {
        //         const opacity = state.isDisabled ? 0.5 : 1;
        //         const transition = 'opacity 300ms';

        //         return { ...base, opacity, transition };
        //     }
        // };

        return (
            <div>

                <section className="b-subpage-hero b-subpage-hero--white has-select-component">
                    <div className="b-subpage-hero__container">
                        <div className="b-subpage-hero__text">
                            <div className="b-subpage-hero__text--inner">
                                <div className="h-wysiwyg-html" dangerouslySetInnerHTML={this.createMarkup()}>
                                </div>

                                <div className="b-subpage-hero__filters">
                                    <div className="b-subpage-hero__filter">
                                        <label>{window.swissLocalization.what_kind_of_space}</label>
                                        <Select
                                            options={this.state.purposeOptions}
                                            value={this.state.selectedPurposeOptions}
                                            onChange={this.handlePurposeOptionChange}
                                            isSearchable={false}
                                            isMulti={true}
                                            isClearable={true}
                                            placeholder={window.swissLocalization.choose}
                                            className="c-option-select"
                                            classNamePrefix="c-option-select"
                                            />
                                    </div>
                                    <div className="b-subpage-hero__filter">
                                        <label>{window.swissLocalization.space_capacity_at_least}</label>
                                        <Select
                                            options={this.state.capacityOptions}
                                            value={this.state.selectedCapacityOption}
                                            onChange={this.handleCapacityOptionChange}
                                            isSearchable={false}
                                            isMulti={false}
                                            isClearable={true}
                                            placeholder={window.swissLocalization.choose}
                                            className="c-option-select"
                                            classNamePrefix="c-option-select"
                                            />
                                    </div>
                                    <div className="b-subpage-hero__filter">
                                        <button className="b-subpage-hero__clear" onClick={this.resetFilters}>{window.swissLocalization.remove_filters}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <div className="l-spaces">
                    <div className="l-spaces__container">
                    {this.state.filteredItems.map( (item, index) => {
                        let currentDate = moment(new Date()).format("YYYY-MM-DD");
                        let itemUrl = 'https://varaamo.hel.fi/resources/' + item.meta.id + '?date=' + currentDate;

                        return (
                            <div className={"l-spaces__item"} key={"space-item-" + index}>
                                <div className="c-space">
                                    <h2 className="c-space__title">{item.post_title[this.state.language]}</h2>
                                    <div className="c-space__wrapper">
                                        <div className="c-space__content">
                                            <p className="c-space__description">
                                                {this.truncateString(item.meta.description[this.state.language])}
                                            </p>
                                        </div>
                                        <div className="c-space__meta">
                                            <div className="c-space__type">
                                                <p className="c-space__heading">{window.swissLocalization.space_type}</p>
                                                <p>{item.meta.type.name[this.state.language]}</p>
                                            </div>
                                            <div className="c-space__capacity">
                                                <p className="c-space__heading">{window.swissLocalization.space_size}</p>
                                                <p>{item.meta.people_capacity}</p>
                                            </div>
                                        </div>
                                        <div className="c-space__cta">
                                            <a className="c-btn" href={itemUrl} aria-label={item.post_title[this.state.language]}>{window.swissLocalization.extra_info_and_reserve}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        );
                    })}
                    </div>
                </div>
            </div>
        );
    }
}


// Render featured activity component
const respaEl = document.getElementById('respa');
if ( respaEl != null ) {
    ReactDOM.render(<Respa />, respaEl);
}
