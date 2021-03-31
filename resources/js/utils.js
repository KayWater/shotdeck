export  function snakeCaseToCamelCase(data) {
    let camel = function(value) {
        return value.replaceAll(/(-|_)/g, ' ').toLowerCase()
            .replace(/( |^)[a-z]/g, (s) => s.toUpperCase())
            .replaceAll(' ', '')
            .replace(/^[A-Z]/g, (s) => s.toLowerCase());
    };

    if (typeof data == 'string') {
        return camel(data);
    }

    if (Array.isArray(data)) {
        return data.map(function(item, index){
            return snakeCaseToCamelCase(item);
        });
    }

    if (typeof data == 'object') {
        let obj = new Object();
        for (const [key, value] of Object.entries(data)) {
            let formattedValue = value;
            if (Array.isArray(value)) {
                formattedValue = value.map(function(item, index){
                    return snakeCaseToCamelCase(item);
                });
            }

            if (typeof value == 'object' && value != null) {
                formattedValue = snakeCaseToCamelCase(value);
            }
            obj = Object.assign(obj, {
                [camel(key)]: formattedValue,
            });
        }
        return obj
    }

    return false;
}