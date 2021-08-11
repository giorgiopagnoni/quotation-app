import { render } from "react-dom";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import PrivateRoute from "./PrivateRoute";
import Login from "./Login";
import QuotationDetail from "./QuotationDetail";
import QuotationList from "./QuotationList";

const App = () => {
    return (
        <header>
            <Router>
                <Switch>
                    <Route path="/login">
                        <Login />
                    </Route>
                    <PrivateRoute
                        path="/quotation/:id"
                        comp={QuotationDetail}
                    />
                    <PrivateRoute exact path="/" comp={QuotationList} />
                </Switch>
            </Router>
        </header>
    );
};

render(<App />, document.getElementById("root"));
