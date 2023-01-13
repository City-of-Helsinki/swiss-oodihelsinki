import React from 'react';
import DayPicker, { DateUtils } from 'react-day-picker';
import 'react-day-picker/lib/style.css';

// Include the locale utils designed for moment
import MomentLocaleUtils from 'react-day-picker/moment';
// Make sure moment.js has the required locale data
import 'moment/locale/fi';
import 'moment/locale/sv';

export default class DatePicker extends React.Component {
    constructor(props) {
        super(props);
        this.datePickerRef = React.createRef();
        this.state = {
            startDate: "",
            endDate: ""
        };

        this.updateStartDate = this.updateStartDate.bind(this);
        this.updateEndDate = this.updateEndDate.bind(this);
        this.updateInputs = this.updateInputs.bind(this);
    }

    componentDidMount(){
        var dates = this.props.selectedDays;
        var startDate = (dates[1].from !== null ? dates[1].from : '' );
        var endDate = (dates[1].to !== null ? dates[1].to : '' );
        this.setState({
            startDate: startDate,
            endDate: endDate
        });
    }

    componentWillUpdate(){

    }

    componentDidUpdate(prevProps) {
        if ( !prevProps.isVisible && this.props.isVisible != prevProps.isVisible ) {
            this.dayPicketInputs.children[0].focus();
            this.datePickerRef.dayPicker;
        }
    }

    updateStartDate(e){
        this.setState({
            startDate: e.target.value
        });
        this.props.injectStartDate(e.target.value);
    }

    updateEndDate(e){
        this.setState({
            endDate: e.target.value
        });
        this.props.injectEndDate(e.target.value);
    }

    
    updateInputs(e){ // Might be wanted at some point
        var fetchedDate = new Date(e);

        if( this.props.selectedDays[1].from && this.props.selectedDays[1].to ){
            var prevStartDate = new Date(this.props.selectedDays[1].from);
            var prevEndDate = new Date(this.props.selectedDays[1].to);
            var formattedDate = (fetchedDate !== null ? ('0' + fetchedDate.getDate()).slice(-2) +'.'+ ('0' + (fetchedDate.getMonth() + 1)).slice(-2) + '.' + (fetchedDate.getFullYear()): '' );

            if( prevStartDate.getTime() > fetchedDate.getTime() ){ // extend start date to earlier date    ("0" + "10").slice(-2)
                this.setState({
                    startDate: formattedDate,
                });
            } else if( prevStartDate.getTime() < fetchedDate.getTime() && prevEndDate.getTime() > fetchedDate.getTime() ){ // middle, shorted end date
                this.setState({
                    endDate: formattedDate
                });
            } else if( prevEndDate.getTime() < fetchedDate.getTime() ){ // after end date, extend end date
                this.setState({
                    endDate: formattedDate
                });
            } else if( prevStartDate.getTime() == fetchedDate.getTime() || prevEndDate.getTime() == fetchedDate.getTime() ){ // target specific day
                this.setState({
                    startDate: formattedDate,
                    endDate: formattedDate
                });
            } else {
                this.setState({
                    startDate: '',
                    endDate: ''
                });
            }
    
            /*
            this.setState({
                startDate: (fetchedDate !== null ? (fetchedDate.getDate()) +'.'+ ((fetchedDate.getMonth().length === 1 ? '0' + fetchedDate.getMonth() : fetchedDate.getMonth())) + '.' + (fetchedDate.getFullYear()): '' ),
                endDate: (fetchedDate !== null ? (fetchedDate.getDate()) +'.'+ ((fetchedDate.getMonth().length === 1 ? '0' + fetchedDate.getMonth() : fetchedDate.getMonth())) + '.' + (fetchedDate.getFullYear()): '' )
            });
            */
        } else if( e ){

            if( !this.props.selectedDays[1].from ){
                this.setState({
                    startDate: (fetchedDate !== null ? (fetchedDate.getDate()) +'.'+ ((fetchedDate.getMonth().length === 1 ? '0' + fetchedDate.getMonth() : fetchedDate.getMonth())) + '.' + (fetchedDate.getFullYear()): '' )
                });
            } else {
                this.setState({
                    endDate: (fetchedDate !== null ? (fetchedDate.getDate()) +'.'+ ((fetchedDate.getMonth().length === 1 ? '0' + fetchedDate.getMonth() : fetchedDate.getMonth())) + '.' + (fetchedDate.getFullYear()): '' )
                });
            }
        }
    }

    render() {
        return (
                <div>
                    <div className="c-icon__close c-icon__close--right" onClick={this.props.onCloseClick}>&times;</div>
                    <div className="DayPickerInputs" ref={el => this.dayPicketInputs = el}>
                        <input type="text" placeholder={window.swissLocalization.startdate_dd_mm_yyyy} aria-label={window.swissLocalization.startdate_label_dd_mm_yyyy} name="startDate" value={this.state.startDate} onChange={this.updateStartDate} />
                        <input type="text" placeholder={window.swissLocalization.enddate_dd_mm_yyyy} aria-label={window.swissLocalization.enddate_label_dd_mm_yyyy} name="endDate" value={this.state.endDate} onChange={this.updateEndDate} />
                    </div>
                    <DayPicker
                        tabindex="-1"
                        aria-label={window.swissLocalization.calendar_date_aria_explanation}
                        selectedDays={this.props.selectedDays}
                        onDayClick={this.props.onDayClick}
                        onDayMouseUp={this.updateInputs}
                        numberOfMonths={2}
                        modifiers={this.props.modifiers}
                        localeUtils={MomentLocaleUtils}
                        locale={this.props.locale}
                        disabledDays={[{
                              before: new Date(),
                        }]}
                        ref={el => this.datePickerRef = el}
                        />
                </div>
        );
    }
}

