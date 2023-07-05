$('#form').validate(
    {
        rules: {
            'name': 'required',
            'package_name': {
                required: true,
                // url: true,
            },
            'api':'required',
            // 'server_key': 'required'
        }, messages: {
            'name': 'Application Name Is Required',
            'package_name': {
                required: 'Package Name Is Required',
                // url: 'Enter Valid URL',
            },
            'api':'Token Api Is Required',
            // 'server_key': 'Time id Required'
        }
    }
)
