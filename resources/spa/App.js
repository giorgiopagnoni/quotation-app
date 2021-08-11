import { render } from "react-dom";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import PrivateRoute from "./PrivateRoute";
import Login from "./Login";
import QuotationEdit from "./QuotationEdit";
import QuotationList from "./QuotationList";

const App = () => {
    return (
        <header>
            <Router>
                <Switch>
                    <Route path="/login">
                        <Login />
                    </Route>
                    <PrivateRoute exact path="/" comp={QuotationList} />
                    <PrivateRoute path="/quotation/:id" comp={QuotationEdit} />
                </Switch>
            </Router>
        </header>
    );
};

render(<App />, document.getElementById("root"));
