const goBack = () => {
    if (document.referrer == undefined
        || document.referrer.indexOf('127.0.0.1:8000/') === -1
    ) {
        return window.location.replace('127.0.0.1/');
    }

    if (document.referrer == document.URL) {
        return window.location.replace(
            document.referrer.replace(/(\/create$|\/edit$|\/[\d]+$)/, '')
        );
    }

    return window.location.replace(document.referrer);
}

export { goBack };
