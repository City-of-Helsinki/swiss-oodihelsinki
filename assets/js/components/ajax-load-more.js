const React = require('react');
const ReactDOM = require('react-dom');

const parsedUrl = location.href.split('/tag/');

let TagFromUrl = null;

if(parsedUrl.length > 1) {
    TagFromUrl = parsedUrl[1].split('/')[0];
}

//console.log(TagFromUrl);

const Loading = props => {
    return (
        <div className="c-loading">
            <div className="c-loading__inner"></div>
            <div className="c-loading__inner"></div>
            <div className="c-loading__inner"></div>
        </div>
    );
};

const Tag = props => {
    const tagClass = "c-btn c-tag-filter " + props.class;
    return (
        <div className={tagClass} tabIndex="0" onKeyUp={props.onKeyUp} onClick={props.onClick}>
            {props.name}
        </div>
    );
};

const Item = ({data: {post_title,post_image,post_permalink,post_date,event_location,event_starts,event_ends, custom_class}}) => {
    const style = {
        backgroundImage: "url("+post_image+")",
    };
    const classes = 'c-card trigger-hover '+custom_class;

    const eventFields =  event_starts ? (<div className="c-card__event-fields">
    <div className="c-card__event-time"><i className="c-icon c-icon__clock"></i>{event_starts}</div>
    <div className="c-card__event-location"><i className="c-icon c-icon__marker"></i>{event_location}</div>
    </div>) : ('') ;

    // const meta = event_starts ? (<div className="c-card__meta">{window.swissLocalization['event']}</div>) : (<div className="c-card__meta">{post_date}</div>);
    const meta = <p>{post_date}</p>;

    return (

    <div className="l-cards__item">
        <a className={classes} href={post_permalink} aria-label={post_title} title={post_title}>
            <div className="c-card__imagewrapper">
                <div className="c-card__image" style={style}>
                </div>
            </div>
            <div className="c-card__content">
                {meta}
                <h4 className="c-card__title">
                    <div title={post_title}>{post_title}</div>
                </h4>
                {eventFields}
                <div className="c-card__readmore">
                    <div className="c-btn c-btn--arrow">{window.swissLocalization['read_more']}</div>
                </div>
            </div>

        </a>
    </div>
    );
};

class Filter extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            allWpPosts: [],
            wpPosts: [],
            tags: [],
            loading: true,
            start: 0,
            end: 11,
            perPage: 4,
            activeTag: null
        };

        this.handleShowMore = this.handleShowMore.bind(this);

    }

    fetchData() {
        const lang = $('html').attr('data-wpml');
        var ajaxurl = lang ? '/'+lang+'/wp-json/swiss/v1/posts/' : '/wp-json/swiss/v1/posts/';
        $.ajax({
            url: ajaxurl,
            type: 'GET',
            success: function(data) {
                let allTags = [];
                for (let key in data) {
                    let postTags = data[key]['post_tags'] ? data[key]['post_tags'].map(tag => tag.name) : [];
                    postTags = postTags.filter(tag => allTags.indexOf(tag) == -1 && tag.length > 0);
                    allTags = allTags.concat(postTags);
                }
                this.setState((prevState, props) => {
                    return { allWpPosts: data, wpPosts: data, loading: false, tags:allTags };
                });
                if (TagFromUrl) {
                    this.filterByTag(TagFromUrl);
                }
            }.bind(this),
        });
    }

    componentDidMount(){
        this.fetchData();
    }

    handleShowMore(e){
        e.preventDefault();
        this.setState(
            (prevState) => {
            return {end: prevState.end + prevState.perPage};
            }
        );
        if (this.state.end+this.state.perPage >= this.state.wpPosts.length) {
            $('.js-loadmore').hide();
        }
    }

    filterByTag(tag) {
        if( $(this).attr('aria-label') === false ){
            $(this).attr('aria-label', 'true');
        } else {
            $(this).attr('aria-label', 'false');
        }
        if (tag == 'clear-all-filters') {
            let allWpPosts = [...this.state.allWpPosts];
            $('.c-card').addClass('c-card--removing');
            setTimeout(() => {
                this.setState({
                    wpPosts: allWpPosts,
                    activeTag: null
                });
                $('.c-card').removeClass('c-card--removing');
            }, 100);
            if (allWpPosts.length > this.state.end) {
                $('.js-loadmore').show();
            }
            return;
        }
        let wpPostsWithTag = [];
        for (let key in this.state.allWpPosts) {
            let activeTags = 0;
            for (let key2 in this.state.allWpPosts[key].post_tags) {
                if (this.state.allWpPosts[key].post_tags[key2].name == tag) {
                    activeTags+=1;
                }
            }
            if (activeTags > 0) {
                wpPostsWithTag.push(this.state.allWpPosts[key]);
            }
        }
        $('.c-card').addClass('c-card--removing');
        setTimeout(() => {
        this.setState({
            wpPosts: wpPostsWithTag,
            activeTag: tag
        });
        $('.c-card').removeClass('c-card--removing');
    }, 100);
        if (wpPostsWithTag.length <= this.state.end) {
            $('.js-loadmore').hide();
        }
        else {
            $('.js-loadmore').show();
        }
    }

    /**
     * Handler for `enter` keypresses to allow keyboard usage of this component.
     * @param  {[type]} e    [Event]
     * @param  {[type]} item [WP Post item]
     * @return {[type]}      [description]
     */
    handleKeyPress(e, item) {
        if (e.keyCode == 13) {
            this.filterByTag(item);
        }
    }

    render() {

        // a very dirty way to create a array of filtered wpPosts
        const wpPosts = this.state.wpPosts.slice(this.state.start, this.state.end);
        const tags = this.state.tags;

        return (
            <React.Fragment>


                <div className="b-blog__filters">
                    <div className="b-blog__filters--inner">
                        <div>
                            {tags.map(item => item === this.state.activeTag ? <Tag key={item} class="active" aria-role="button" aria-checked="false" name={item} onKeyUp={(e) => this.handleKeyPress(e, item)} onClick={() => this.filterByTag(item)}/> : <Tag key={item} class="default" name={item} onKeyUp={(e) => this.handleKeyPress(e, item)} onClick={() => this.filterByTag(item)}/>) }
                        </div>

                        <button className="c-tag-filter c-tag-filter--clear c-btn" aria-checked="false" onClick={() => this.filterByTag('clear-all-filters')}>
                        { window.swissLocalization['remove_filters'] }
                        </button>
                    </div>
                </div>

                <div className="b-blog__posts-listing">
                    {this.state.loading && <Loading />}

                <div className="b-blog__highlight-wrapper s-context s-context--grey">
                    <div className="l-cards has-tall-cards">
                        {/* TODO: Sooooooo we kinda need to do the actual containers
                          and stuff here instead of in the PHP template, in order
                          do to the layout in some sane way. Currently we are just
                          faking it in CSS but that should be removed. */}
                        {wpPosts.slice(0, 3).map((item, index) => <Item key={item.ID} data={item}/>)}
                    </div>
                </div>

                    <div className="b-section s-context">
                    <div className="l-cards l-cards--blog">
                        {wpPosts.slice(3).map((item, index) => <Item key={item.ID} data={item}/>)}
                    </div>
                    </div>
                </div>

                <a className="b-blog__loadmore" aria-label={ window.swissLocalization['show_more'] } href="#" onClick={this.handleShowMore}>
                    <span aria-hidden="true" className="c-btn js-loadmore">{ window.swissLocalization['show_more'] }</span>
                </a>

            </React.Fragment>
        );
    }
}

if($('.js-ajax-loadmore-content').length) {
    ReactDOM.render(<Filter />, document.querySelector('.js-ajax-loadmore-content'));
}
