// component.jsx
import React from "react";
import ReactDOM from "react-dom";
import moment from "moment";

// Parent component

class FeaturedActivities extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            items: [], // all items
            filteredItems: [], // only filtered items
            itemsLoading: 0,
            dates: [],
            types: [],
            locations: [],
            activeDates: [], // currently active date filters
            activeLocations: [], // currently active date filters
            activeTypes: [] // currently active date filters
        };

        this.loadActivities = this.loadActivities.bind(this);
        this.onFilterChange = this.onFilterChange.bind(this);
        this.updateItems = this.updateItems.bind(this);
        this.setFirstDate = this.setFirstDate.bind(this);
        this.resetFilters = this.resetFilters.bind(this);
    }

    loadActivities() {
        if (!this.state.itemsLoading) {
            this.setState({ itemsLoading: 1 });

            let language = document.documentElement.dataset.wpml;
            $.get(
                "/wp-json/swiss/v1/featured-activities/?lang=" + language,
                function(json) {
                    this.setState({
                        items: json.posts,
                        dates: json.taxonomies.dates.sort((a, b) => {
                            if (a.slug < b.slug) {
                                return -1;
                            }
                            if (a.slug > b.slug) {
                                return 1;
                            }
                            return 0;
                        }),
                        types: json.taxonomies.types.sort((a, b) => {
                            if (a.slug < b.slug) {
                                return -1;
                            }
                            if (a.slug > b.slug) {
                                return 1;
                            }
                            return 0;
                        }),
                        locations: json.taxonomies.locations.sort((a, b) => {
                            if (a.slug < b.slug) {
                                return -1;
                            }
                            if (a.slug > b.slug) {
                                return 1;
                            }
                            return 0;
                        })
                    });
                    this.setState({ itemsLoading: 2 });

                    // Update items once they are loaded, to establish filteredItems
                    this.updateItems();
                    this.setFirstDate();
                }.bind(this)
            );
        }
    }

    resetFilters(e) {
        e.preventDefault();
        this.setState({ activeLocations: [], activeTypes: [] }, () => {
            this.updateItems();
        });
    }

    setFirstDate() {
        let firstDateOption = this.state.dates[0].term_id.toString();
        this.setState({ activeDates: [firstDateOption] }, () => {
            this.updateItems();
        });
    }

    onFilterChange(event, item) {
        const target = event.target;
        const value = target.value;
        const name = target.name;
        const type = target.type;

        // Refer to the state based on the name of the input. This allows us to
        // keep the function modular and multi-purpose.
        let s = this.state[name];

        // Update active date filters for checkboxes.
        if (type === "checkbox") {
            if (event.target.checked) {
                this.setState({ [name]: s.concat([value]) }, () => {
                    this.updateItems();
                });
            } else {
                this.setState(
                    {
                        [name]: s.filter(function(val) {
                            return val !== value;
                        })
                    },
                    () => {
                        this.updateItems();
                    }
                );
            }
            // Update items for checkboxes
        } else if (type === "radio") {
            this.setState({ [name]: [value] }, () => {
                this.updateItems();
            });
        }
    }

    updateItems() {
        let _this = this;

        // If no filters are selected, show all posts
        if (
            this.state.activeDates.length == 0 &&
            this.state.activeLocations.length == 0 &&
            this.state.activeTypes.length == 0
        ) {
            this.setState({
                filteredItems: this.state.items
            });
        } else {
            // Otherwise (e.g. if ANY filter is selected), display a filtered list
            // TODO: Redo in some sane way.
            this.setState({
                filteredItems: _this.state.items.filter(function(post) {
                    if (!post.activity_dates) {
                        post.activity_dates = [];
                    }
                    if (!post.activity_locations) {
                        post.activity_locations = [];
                    }
                    if (!post.activity_types) {
                        post.activity_types = [];
                    }
                    return (
                        post.activity_dates.some(function(v) {
                            if (_this.state.activeDates.length == 0) {
                                return true;
                            } else {
                                return (
                                    _this.state.activeDates.indexOf(
                                        v.term_id.toString()
                                    ) >= 0
                                );
                            }
                        }) &&
                        post.activity_locations.some(function(x) {
                            if (_this.state.activeLocations.length == 0) {
                                return true;
                            } else {
                                return (
                                    _this.state.activeLocations.indexOf(
                                        x.term_id.toString()
                                    ) >= 0
                                );
                            }
                        }) &&
                        (post.activity_types.length == 0 ||
                            post.activity_types.some(function(x) {
                                if (_this.state.activeTypes.length == 0) {
                                    return true;
                                } else {
                                    return (
                                        _this.state.activeTypes.indexOf(
                                            x.term_id.toString()
                                        ) >= 0
                                    );
                                }
                            }))
                    );
                })
            });
        }
    }

    componentWillMount() {
        this.loadActivities();
    }

    render() {
        return (
            <div className="c-featured-activities">
                <div className="c-featured-activities__filter-wrapper c-featured-activities__filter-wrapper--tabbed">
                    <ul className="c-featured-activities__filters c-featured-activities__filters--tabbed">
                        {this.state.dates.map(function(item, index) {
                            return (
                                <ActivityFilter
                                    key={"date-filter-item-" + index}
                                    type="radio"
                                    item={item}
                                    filterType="activeDates"
                                    checked={
                                        this.state.activeDates.includes(
                                            item.term_id.toString()
                                        )
                                            ? true
                                            : false
                                    }
                                    onChange={this.onFilterChange}
                                />
                            );
                        }, this)}
                    </ul>
                </div>

                {this.state.dates
                    .filter(
                        item =>
                            item.term_id.toString() == this.state.activeDates[0]
                    )
                    .map(function(item, index) {
                        return (
                            <p
                                className="c-featured-activities__description"
                                key={"date-description-" + index}
                            >
                                {item.description}
                            </p>
                        );
                    })}

                <div className="c-featured-activities__filtering">
                    <div className="c-featured-activities__filter-wrapper">
                        {this.state.locations.length > 0 && (
                            <p className="c-featured-activities__filter-title">
                                {window.swissLocalization.location}:
                            </p>
                        )}
                        <ul className="c-featured-activities__filters">
                            {this.state.locations.map(function(item, index) {
                                return (
                                    <ActivityFilter
                                        key={"location-filter-item-" + index}
                                        type="checkbox"
                                        item={item}
                                        filterType="activeLocations"
                                        checked={
                                            this.state.activeLocations.includes(
                                                item.term_id.toString()
                                            )
                                                ? true
                                                : false
                                        }
                                        onChange={this.onFilterChange}
                                    />
                                );
                            }, this)}
                        </ul>
                    </div>

                    <div className="c-featured-activities__filter-wrapper">
                        {this.state.types.length > 0 && (
                            <p className="c-featured-activities__filter-title">
                                {window.swissLocalization.type}:
                            </p>
                        )}
                        <ul className="c-featured-activities__filters">
                            {this.state.types.map(function(item, index) {
                                return (
                                    <ActivityFilter
                                        key={"type-filter-item-" + index}
                                        type="checkbox"
                                        item={item}
                                        filterType="activeTypes"
                                        checked={
                                            this.state.activeTypes.includes(
                                                item.term_id.toString()
                                            )
                                                ? true
                                                : false
                                        }
                                        onChange={this.onFilterChange}
                                    />
                                );
                            }, this)}
                        </ul>
                    </div>

                    <button
                        className="c-featured-activities__clear"
                        onClick={this.resetFilters}
                    >
                        {window.swissLocalization.remove_filters}
                    </button>
                </div>
                <div className="c-featured-activities__items-wrapper">
                    <div className="c-featured-activities__items">
                        {this.state.filteredItems.length == 0 && (
                            <div>
                                <p>
                                    {
                                        window.swissLocalization
                                            .no_activities_found
                                    }
                                </p>
                            </div>
                        )}

                        {this.state.filteredItems.length > 0 && (
                            <div className="c-featured-activities__items__legend">
                                <div>{window.swissLocalization.time}</div>
                                <div>{window.swissLocalization.programme}</div>
                                <div>
                                    {window.swissLocalization.information}
                                </div>
                                <div>{window.swissLocalization.type}</div>
                            </div>
                        )}
                        {this.state.filteredItems
                            .sort((a, b) => a.activity_time - b.activity_time)
                            .map(function(item, index) {
                                return (
                                    <ActivityItem
                                        key={index.toString()}
                                        item={item}
                                        index={"activity-item-" + index}
                                    />
                                );
                            })}
                    </div>
                </div>
            </div>
        );
    }
}

// Individual item component
class ActivityItem extends React.Component {
    timestampToTime(timestamp) {
        let date = new Date(timestamp * 1000);
        let hours = date.getHours();
        let minutes = (date.getMinutes() < 10 ? "0" : "") + date.getMinutes();

        return hours + ":" + minutes;
    }

    formatTimestamp(dateTimeStamp) {
        let dateTime = moment.unix(dateTimeStamp).utc();
        if (dateTime.isValid() === false) {
            return "";
        }
        return dateTime.format("HH:mm");
    }

    render() {

        let startTimeEl = '';
        let endTimeEl = '';

        if ( this.props.item.activity_time ) {
            startTimeEl = <time dateTime={this.formatTimestamp(this.props.item.activity_time)}>{this.formatTimestamp(this.props.item.activity_time)}</time>;
        }

        if ( this.props.item.activity_end_time ) {
            endTimeEl = <time dateTime={this.formatTimestamp(this.props.item.activity_time)}> - {this.formatTimestamp(this.props.item.activity_end_time)}</time>;
        }

        return (
            <div className="c-featured-activities__item">
                <div className="c-featured-activities__item__time">
                    <p>
                        {startTimeEl}
                        {endTimeEl}
                    </p>
                </div>
                <div className="c-featured-activities__item__info">
                    <h4>{this.props.item.post_title}</h4>
                    <p>{this.props.item.description}</p>
                </div>
                <div className="c-featured-activities__item__locations">
                    <p>{this.props.item.activity_locations[0].name}</p>
                    <p>{this.props.item.specific_location}</p>
                </div>
                <div className="c-featured-activities__item__types">
                    {this.props.item.activity_types.map((item, index) => {
                        return <span key={item.name}>{item.name}</span>;
                    })}
                </div>
            </div>
        );
    }
}

// Collection of filters
class ActivityFilter extends React.Component {
    render() {
        return (
            <li className="c-featured-activities__filter">
                <label htmlFor={this.props.item.term_id}>
                    <input
                        name={this.props.filterType}
                        type={this.props.type}
                        id={this.props.item.term_id}
                        value={this.props.item.term_id}
                        onChange={e => {
                            this.props.onChange(e, this.props.item);
                        }}
                        checked={this.props.checked}
                    />

                    <span>{this.props.item.name}</span>
                </label>
            </li>
        );
    }
}

// Render featured activity component
const featuredActivitiesEl = document.getElementById("featured-activities");
if (featuredActivitiesEl != null) {
    ReactDOM.render(<FeaturedActivities />, featuredActivitiesEl);
}
