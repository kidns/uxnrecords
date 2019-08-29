login = async (req, res, next) => {
    try {
        request(`https://graph.facebook.com/me?access_token=${req.body.token}`, (error, response, body) => {
            body = (body) ? JSON.parse(body) : { id: null };
            if (body.id) {
                return res.status(200).json({ body }); ///
            } else {
                const err = new Error('Tài khoản không được phép đăng nhập.');
                err.status = 401;
                return next(err);
            }
        });
    } catch (err) {
        next(err);
    }
}

function f() {
    return data;
}

const  a = f ();
