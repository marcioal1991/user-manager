import Container from "@mui/material/Container";
import CssBaseline from "@mui/material/CssBaseline";
import Box from "@mui/material/Box";
import {Alert, CircularProgress} from "@mui/material";
import Copyright from "../components/Copyright";
import {createTheme, ThemeProvider} from "@mui/material/styles";
import * as React from "react";
import {useState} from "react";
import * as PropTypes from "prop-types";

const defaultTheme = createTheme();

function CheckIcon(props) {
    return null;
}

CheckIcon.propTypes = {fontSize: PropTypes.string};
export default function EmailVerification() {
    const [state, setState] = useState(0);

    function loop() {
        let o = setTimeout(function () {
            clearTimeout(o)
            setState(state === 2 ? 0 : state + 1);
            loop();
        }, 5000);
    }

    loop();

    return (
        <ThemeProvider theme={defaultTheme}>
            <Container component="main" maxWidth="xs">
                <CssBaseline />
                <Box
                    sx={{
                        marginTop: 8,
                        display: 'flex',
                        flexDirection: 'column',
                        alignItems: 'center',
                    }}
                >
                    {state === 0 && (
                        <div>
                            <div
                                style={{
                                    display: 'flex',
                                    justifyContent: 'center',
                                    marginBottom: '10px'
                                }}
                            >
                                <CircularProgress disableShrink />
                            </div>
                            <div>
                                <Alert icon={<CheckIcon fontSize="inherit" />} severity="warning">
                                    Your account is being verified.
                                </Alert>
                            </div>
                        </div>
                    )}
                    {state === 1 && (
                        <Alert icon={<CheckIcon fontSize="inherit" />} severity="success">
                            Your email has been verified successfully.
                        </Alert>
                    )}
                    {state === 2 && (
                        <Alert icon={<CheckIcon fontSize="inherit" />} severity="error">
                            Something went wrong, request a new verification link.
                        </Alert>
                    )}
                </Box>
                <Copyright sx={{ mt: 5 }} />
            </Container>
        </ThemeProvider>
    )
}
