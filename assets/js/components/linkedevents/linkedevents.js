import React from "react";
import ReactDOM from "react-dom";
import moment from "moment";
import DayPicker, { DateUtils } from "react-day-picker";
import DatePicker from "./datepicker";
import DOMPurify from "dompurify";

// Parent component
class LinkedEvents extends React.Component {
    constructor(props) {
        super(props);

        this.state = this.getInitialState();

        this.loadEvents = this.loadEvents.bind(this);
        this.formatTimestamp = this.formatTimestamp.bind(this);
        this.updateEvents = this.updateEvents.bind(this);
        this.setLanguage = this.setLanguage.bind(this);
        this.slugify = this.slugify.bind(this);
        this.selectToday = this.selectToday.bind(this);
        this.selectTomorrow = this.selectTomorrow.bind(this);
        this.toggleDatePicker = this.toggleDatePicker.bind(this);
        this.resetFilters = this.resetFilters.bind(this);
        this.isDaySelected = this.isDaySelected.bind(this);
        this.handleDayClick = this.handleDayClick.bind(this);
        this.handleResetClick = this.handleResetClick.bind(this);
        this.createMarkup = this.createMarkup.bind(this);
        this.injectStartDate = this.injectStartDate.bind(this);
        this.injectEndDate = this.injectEndDate.bind(this);
    }

    getInitialState() {
        return {
            items: [], // all items
            filteredItems: [], // items with filters applied
            langFiltered: [], // filtered items with lang-filter
            itemsLoading: 0,
            language: "fi",
            from: null,
            to: null,
            selectedDays: [], // Datepicker selected days
            datePickerActive: false, // Is datePicker active or not
            highlighted: false,
            visibleItems: 9,
            loadMoreItems: 18
        };
    }

    componentWillMount() {
        this.setLanguage();
        this.loadEvents();
        const highlighted = document
            .getElementById("linkedevents")
            .getAttribute("data-highlighted")
            .split(",")
            .slice(0, -1);
        this.setState({ highlighted: highlighted });
    }

    handleDayClick(day) {
        const range = DateUtils.addDayToRange(day, this.state);
        this.setState(range, () => {
            this.updateEvents();
        });
    }

    handleResetClick() {
        this.setState(this.getInitialState());
    }

    setLanguage() {
        let lang = document.documentElement.dataset.wpml;
        if (lang == "") {
            lang = "fi";
        }
        this.setState({ language: lang });
    }

    formatTimestamp(dateTimeString, format) {
        let dateTime = moment(dateTimeString);
        if (dateTime.isValid() === false) {
            return "";
        }
        return dateTime.format(format);
    }

    isMultipleDays(item) {
        const Day1 = new Date(item.meta.start_time).toDateString();
        const Day2 = new Date(item.meta.end_time).toDateString();
        return Day1 != Day2;
    }

    loadEvents() {
        if (!this.state.itemsLoading) {
            this.setState({ itemsLoading: 1 });

            $.get(
                "/wp-json/linkedevents/v1/events",
                function(json) {
                    //console.log(json);
                    this.setState({
                        items: json
                    });
                    this.setState({ itemsLoading: 2 });

                    // Update items once they are loaded, to establish filteredItems
                    this.updateEvents();
                }.bind(this)
            );
        }
    }

    updateEvents() {
        let _this = this;

        // Show all if no date is selected
        if (this.state.from == null && this.state.to == null) {
            this.setState({
                filteredItems: this.state.items
            });
        } else {
            this.setState({
                filteredItems: _this.state.items.filter(function(item) {
                    let eventStartDate = moment(item.meta.start_time);
                    let eventEndDate = moment(item.meta.end_time);
                    let stateFrom = moment(_this.state.from);
                    let stateTo = moment(_this.state.to);
                    // If either the start or end dates of an even fall between selected range
                    return (
                        eventStartDate.isBetween(
                            stateFrom,
                            stateTo,
                            "day",
                            "[]"
                        ) ||
                        eventEndDate.isBetween(stateFrom, stateTo, "day", "[]")
                    );
                })
            });
        }
    }

    /**
     * Slugify a given string by trimming all URL-unfriendly characters from it.
     * Used to generate friendly URLs for events, which do not actually have real
     * URLs (as they're not WP posts).
     * @param {string} text - the text to slugify.
     * @returns {string} the slugified string.
     */
    slugify(text) {
        if (text && text[this.state.language]) {
            let text_local = text[this.state.language];
            return text_local
                .toString()
                .toLowerCase()
                .replace(/\s+/g, "-") // Replace spaces with -
                .replace(/[^\w-]+/g, "") // Remove all non-word chars
                .replace(/--+/g, "-") // Replace multiple - with single -
                .replace(/^-+/, "") // Trim - from start of text
                .replace(/-+$/, ""); // Trim - from end of text
        } else if (text && text["fi"]) {
            let text_local2 = text["fi"];
            //console.log(text_local2);
            return text_local2
                .toString()
                .toLowerCase()
                .replace(/\s+/g, "-") // Replace spaces with -
                .replace(/[^\w-]+/g, "") // Remove all non-word chars
                .replace(/--+/g, "-") // Replace multiple - with single -
                .replace(/^-+/, "") // Trim - from start of text
                .replace(/-+$/, ""); // Trim - from end of text
        } else {
            return;
        }
    }

    resetFilters() {
        this.setState(
            { selectedDays: [], from: null, to: null, datePickerActive: false },
            () => {
                this.updateEvents();
            }
        );
    }

    /**
     * Check if a given date already exists in the selected dates.
     */
    isDaySelected(day) {
        let date = moment(day);
        let stateFrom = moment(this.state.from);
        let stateTo = moment(this.state.to);

        // Check if our date is valid before parsing
        if (stateFrom.isValid() && stateTo.isValid()) {
            return date.isBetween(stateFrom, stateTo, "day", "[]");
        } else {
            return false;
        }
    }

    /**
     * Toggle the date picker visibility
     */
    toggleDatePicker() {
        const currentState = this.state.datePickerActive;
        this.setState({ datePickerActive: !currentState });
    }

    /**
     * Selects `today` as the filtered day.
     */
    selectToday() {
        let day = new Date();
        this.setState({ from: day, to: day }, () => {
            this.updateEvents();
        });
    }

    /**
     * Selects `tomorrow` as the filtered day.
     */
    selectTomorrow() {
        let today = new Date();
        let tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
        this.setState({ from: tomorrow, to: tomorrow }, () => {
            this.updateEvents();
        });
    }

    createMarkup() {
        const content = DOMPurify.sanitize(window.linkedeventsBlockContent);
        return { __html: content };
    }

    loadMore() {
        const items = this.state.visibleItems + this.state.loadMoreItems;
        this.setState({ visibleItems: items });
    }

    injectStartDate(e){
        var d = e.split(".");
        var formattedDate = d[1] + '-' + d[0] + '-' + d[2];

        if (isNaN(Date.parse(formattedDate)) == false){
            this.setState({
                from: new Date(formattedDate)
            });

            this.updateEvents();
        }
    }

    injectEndDate(e){
        var d = e.split(".");
        var formattedDate = d[1] + '-' + d[0] + '-' + d[2];

        if (isNaN(Date.parse(formattedDate)) == false){
            this.setState({
                to: new Date(formattedDate)
            });

            this.updateEvents();
        }
    }

    render() {
        //console.log(this.state.items);
        let highlighted;
        let other;
        let langFiltered = [];
        const SortedItems = this.state.filteredItems.sort((x, y) => {
            let a = new Date(x.meta.start_time);
            let b = new Date(y.meta.start_time);
            return a < b ? -1 : a > b ? 1 : 0;
        });

        {SortedItems.map((item, index) => {
            if (item.post_title[this.state.language]) {
                langFiltered.push(item);
            }
        }
        );}

        if (this.state.highlighted.length > 0) {
            highlighted = langFiltered.filter(item => {
                return this.state.highlighted.includes(item.ID.split(":")[1]);
            });
            other = langFiltered.filter(item => {
                return !this.state.highlighted.includes(item.ID.split(":")[1]);
            });
        } else {
            highlighted = langFiltered.slice(0, 3);
            other = langFiltered.slice(3);
        }

        other = other.slice(0, this.state.visibleItems);

        let today = new Date();
        let tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);

        // console.log(DOMPurify.sanitize(window.linkedeventsBlockContent));

        const { from, to } = this.state;
        const modifiers = { start: from, end: to };

        return (
            <div className="c-linkedevents">
                <section className="b-subpage-hero b-subpage-hero--white has-select-component">
                    <div className="b-subpage-hero__container">
                        <div className="b-subpage-hero__text">
                            <div className="b-subpage-hero__text--inner">
                                <div
                                    className="h-wysiwyg-html"
                                    dangerouslySetInnerHTML={this.createMarkup()}
                                />

                                <div className="b-subpage-hero__filters">
                                    <div className="c-linkedevents__filters">
                                        <button
                                            className="c-btn c-btn--big c-linkedevents__filter"
                                            aria-pressed={
                                                this.isDaySelected(today)
                                                    ? "true"
                                                    : "false"
                                            }
                                            type="button"
                                            onClick={this.selectToday}
                                        >
                                            {window.swissLocalization.today}
                                        </button>
                                        <button
                                            className="c-btn c-btn--big c-linkedevents__filter"
                                            aria-pressed={
                                                this.isDaySelected(tomorrow)
                                                    ? "true"
                                                    : "false"
                                            }
                                            type="button"
                                            onClick={this.selectTomorrow}
                                        >
                                            {window.swissLocalization.tomorrow}
                                        </button>
                                        <button
                                            className="c-btn c-btn--big c-linkedevents__filter c-linkedevents__filter--toggle"
                                            type="button"
                                            aria-pressed={
                                                this.state.datePickerActive
                                                    ? "true"
                                                    : "false"
                                            }
                                            onClick={this.toggleDatePicker}
                                        >
                                            {
                                                window.swissLocalization
                                                    .choose_the_dates
                                            }{" "}
                                            <i className="fas fa-chevron-down" />
                                        </button>
                                        <button
                                            className="b-subpage-hero__clear"
                                            aria-label={
                                                window.swissLocalization
                                                    .remove_filters
                                            }
                                            onClick={this.resetFilters}
                                        >
                                            {
                                                window.swissLocalization
                                                    .remove_filters
                                            }
                                        </button>
                                    </div>
                                </div>

                                <div
                                    className={
                                        "c-linkedevents__datepicker " +
                                        (this.state.datePickerActive
                                            ? "is-active"
                                            : "")
                                    }
                                >
                                    <DatePicker
                                        onDayClick={this.handleDayClick}
                                        onCloseClick={this.toggleDatePicker}
                                        modifiers={modifiers}
                                        selectedDays={[from, { from, to }]}
                                        locale={this.state.language}
                                        isVisible={this.state.datePickerActive}
                                        injectStartDate={this.injectStartDate}
                                        injectEndDate={this.injectEndDate}
                                    />
                                </div>

                                <p>
                                    {from && `${from.toLocaleDateString()}`}
                                    {to &&
                                        from !== to &&
                                        `- ${to.toLocaleDateString()}`}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {this.state.filteredItems.length === 0 && (
                    <p className="c-linkedevents__message">
                        {window.swissLocalization.no_events_found}
                    </p>
                )}
                <div className="b-linkedevents__highlight-wrapper s-context s-context--grey">
                    <div className="l-cards has-tall-cards">
                        {highlighted.map((item, index) => {
                            return (
                                <a
                                    className={"l-cards__item"}
                                    key={"event-item-" + index}
                                    title={
                                        item.post_title[
                                            this.state.language
                                        ]
                                            ? item.post_title[
                                                  this.state
                                                      .language
                                              ]
                                            : item.post_title["fi"]
                                    }
                                    href={
                                        window.location.origin +
                                        "/event/" +
                                        item.ID +
                                        "/" +
                                        this.slugify(
                                            item.post_title
                                        ) +
                                        "?lang=" + 
                                        this.state.language
                                    }
                                >
                                    <div className="c-event-card">
                                        <div className="c-event-card__image">
                                            <img
                                                alt={
                                                    item.post_title[
                                                        this.state.language
                                                    ]
                                                        ? item.post_title[
                                                              this.state
                                                                  .language
                                                          ]
                                                        : item.post_title["fi"]
                                                }
                                                src={
                                                    item.meta.featured_image_url
                                                }
                                            />
                                            <div className="c-event-card__date">
                                                <p>
                                                    <time
                                                        dateTime={this.formatTimestamp(
                                                            item.meta
                                                                .start_time,
                                                            "D.M.YYYY"
                                                        )}
                                                    >
                                                        {this.formatTimestamp(
                                                            item.meta
                                                                .start_time,
                                                            "D.M.YYYY"
                                                        )}
                                                        {this.isMultipleDays(
                                                            item
                                                        ) &&
                                                            " - " +
                                                                this.formatTimestamp(
                                                                    item.meta
                                                                        .end_time,
                                                                    "D.M.YYYY"
                                                                )}
                                                    </time>
                                                </p>
                                            </div>
                                        </div>
                                        <h4 className="c-event-card__title">
                                            <div>
                                                {item.post_title[
                                                    this.state.language
                                                ]
                                                    ? item.post_title[
                                                          this.state.language
                                                      ]
                                                    : item.post_title["fi"]}
                                            </div>
                                        </h4>
                                        <div className="c-event-card__meta">
                                            <p>
                                                {item.event_status === "EventCancelled" && <span className="c-event-card__peruttu">{window.swissLocalization.event_status}</span>}
                                                {" "}<i className="c-icon c-icon__clock" />{" "}
                                                <time
                                                    dateTime={this.formatTimestamp(
                                                        item.meta.start_time,
                                                        "HH:mm"
                                                    )}
                                                >
                                                    {this.formatTimestamp(
                                                        item.meta.start_time,
                                                        "HH:mm"
                                                    )}
                                                </time>
                                            </p>
                                            <p>
                                                <i className="c-icon c-icon__marker" />{" "}
                                                {
                                                    item.meta.location.name[
                                                        this.state.language
                                                    ]
                                                }
                                                {item.meta.location_extra &&
                                                    ", " +
                                                        item.meta
                                                            .location_extra[
                                                            this.state.language
                                                        ]}
                                            </p>
                                        </div>
                                        <div
                                            className="c-btn c-btn--arrow"
                                            title={
                                                item.post_title[
                                                    this.state.language
                                                ]
                                            }
                                        >
                                            {window.swissLocalization.read_more}
                                        </div>
                                    </div>
                                </a>
                            );
                        })}
                    </div>
                </div>
                <div className="l-cards">
                    {other.map((item, index) => {
                        return (
                            <a
                                className={"l-cards__item"}
                                key={"event-item-" + index}
                                title={
                                    item.post_title[
                                        this.state.language
                                    ]
                                        ? item.post_title[
                                              this.state.language
                                          ]
                                        : item.post_title["fi"]
                                }
                                href={
                                    window.location.origin +
                                    "/event/" +
                                    item.ID +
                                    "/" +
                                    this.slugify(item.post_title) +
                                    "?lang=" + 
                                    this.state.language
                                }
                            >
                                <div className="c-event-card">
                                    <div className="c-event-card__image">
                                        <img
                                            alt={
                                                item.post_title[
                                                    this.state.language
                                                ]
                                                    ? item.post_title[
                                                          this.state.language
                                                      ]
                                                    : item.post_title["fi"]
                                            }
                                            src={item.meta.featured_image_url}
                                        />
                                        <div className="c-event-card__date">
                                            <p>
                                                <time
                                                    dateTime={this.formatTimestamp(
                                                        item.meta.start_time,
                                                        "D.M.YYYY"
                                                    )}
                                                >
                                                    {this.formatTimestamp(
                                                        item.meta.start_time,
                                                        "D.M.YYYY"
                                                    )}
                                                </time>
                                            </p>
                                        </div>
                                    </div>
                                    <h4 className="c-event-card__title">
                                        <div>
                                            {item.post_title[
                                                this.state.language
                                            ]
                                                ? item.post_title[
                                                      this.state.language
                                                  ]
                                                : item.post_title["fi"]}
                                        </div>
                                    </h4>
                                    <div className="c-event-card__meta">
                                        <p>
                                            {item.event_status === "EventCancelled" && <span className="c-event-card__peruttu">{window.swissLocalization.event_status}</span>}
                                            {" "}<i className="c-icon c-icon__clock" />{" "}
                                            <time
                                                dateTime={this.formatTimestamp(
                                                    item.meta.start_time,
                                                    "HH:mm"
                                                )}
                                            >
                                                {this.formatTimestamp(
                                                    item.meta.start_time,
                                                    "HH:mm"
                                                )}
                                            </time>
                                        </p>
                                        <p>
                                            <i className="c-icon c-icon__marker" />{" "}
                                            {
                                                item.meta.location.name[
                                                    this.state.language
                                                ]
                                            }
                                        </p>
                                    </div>
                                    <div
                                        className="c-btn c-btn--arrow"
                                        title={
                                            item.post_title[this.state.language]
                                        }
                                    >
                                        {window.swissLocalization.read_more}
                                    </div>
                                </div>
                            </a>
                        );
                    })}
                </div>
                {this.state.visibleItems + 3 <
                    langFiltered.length && (
                    <div style={{ textAlign: "center" }}>
                        <a onClick={() => this.loadMore()} className="c-btn">
                            {window.swissLocalization["show_more"]}
                        </a>
                    </div>
                )}
            </div>
        );
    }
}

// Render featured activity component
const linkedEventsEl = document.getElementById("linkedevents");
if (linkedEventsEl != null) {
    ReactDOM.render(<LinkedEvents />, linkedEventsEl);
}
