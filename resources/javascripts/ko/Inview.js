
const listeners = [];
const states = [];

const isOverlapping = function (x1, x2, y1, y2) {
    return x1 <= y2 && y1 <= x2;
};

const getState = function (element) {
    const filtered = states.filter((s) => s.element === element);
    if (filtered && filtered.length) {
        return filtered[0].value;
    }
};

const setState = function (element, value) {
    const filtered = states.filter((s) => s.element === element);
    if (filtered && filtered.length) {
        filtered[0].value = value;
    } else {
        states.push({ element, value });
    }
};

const bindListener = function (element, listener) {

    window.addEventListener("scroll", listener);

    listeners.push({ element, listener });

    listener();
};

const addListenerObservable = function (element, observable) {

    const listener = function () {

        const rect = element.getBoundingClientRect();
        const isInview = isOverlapping(rect.top, rect.bottom, 0, window.outerHeight);

        if (!isInview && observable()) {
            observable(false);
        }

        if (isInview && !observable()) {
            observable(true);
        }
    };

    bindListener(element, listener);
};

const addListenerCallback = function (element, callback) {

    const listener = function () {

        const rect = element.getBoundingClientRect();
        const isInview = isOverlapping(rect.top, rect.bottom, 0, window.outerHeight);
        const state = getState(element);

        if (!isInview && state) {
            callback(element, false);
            setState(element, false);
        }

        if (isInview && !state) {
            callback(element, true);
            setState(element, true);
        }
    };

    bindListener(element, listener);
};

const removeListener = function (element) {

    return function () {

        const listener = listeners.filter((l) => l.element === element);

        if (listener[0]) {
            window.removeEventListener("scroll", listener[0].listener);
        }
    };
};

const binding = function (ko) {

    ko = ko || window.ko;

    const init = function (element, valueAccessor) {

        const value = valueAccessor();

        if (ko.isObservable(value)) {
            addListenerObservable(element, value);
        } else if (value instanceof Function) {
            addListenerCallback(element, value);
        }

        ko.utils.domNodeDisposal.addDisposeCallback(element, removeListener(element));
    };

    return { init };
};

export default binding;
