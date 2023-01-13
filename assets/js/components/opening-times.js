import React from "react";
import ReactDOM from "react-dom";
import moment from "moment";

class OpeningTimes extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            openingTimesURL: ""
        };

        this.loadOpeningTimesURL = this.loadOpeningTimesURL.bind(this);
    }

    // Load the INTERNAL page URL for opening times, which is supposed to display
    // opening times of Oodi. Actual implementation of this TBA.
    loadOpeningTimesURL() {
        $.get(
            "/wp-json/swiss/v1/opening-times-url",
            function(json) {
                this.setState({
                    openingTimesURL: json[0]
                });
            }.bind(this)
        );
    }

    componentWillMount() {
        this.loadOpeningTimesURL();
    }

    render() {
        return (
            <div className="b-site-header__opening-times">
                <div className="c-opening-times">
                    <p className="c-opening-times__times">
                        {window.swissLocalization.open_today}{" "}
                        <span>
                            <time dateTime="yyyy-mm-dd">x</time>
                        </span>
                    </p>
                    <a
                        className="c-opening-times__link"
                        href={this.state.openingTimesURL}
                    >
                        {window.swissLocalization.all_opening_times}
                    </a>
                </div>
            </div>
        );
    }
}

// Render featured activity component
const openingTimesEl = document.getElementById("opening-times");
if (openingTimesEl != null) {
    ReactDOM.render(<OpeningTimes />, openingTimesEl);
}
