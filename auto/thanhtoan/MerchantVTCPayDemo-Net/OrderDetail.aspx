<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="OrderDetail.aspx.cs" Inherits="WebSitePayment.OrderDetail" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">


<head runat="server">
    <title>Sample paygate</title>
    <style type="text/css">
        .style1 {
            height: 18px;
        }
    </style>
</head>
<body>
    <form id="form1" runat="server">
        <div>

            <table>

                <tr>
                    <td>Hệ thống
                    </td>
                    <td>
                        <asp:DropDownList ID="ddlEnvinroment" runat="server" AutoPostBack="True" OnSelectedIndexChanged="ddlEnvinroment_SelectedIndexChanged">
                            <asp:ListItem Text="Sandbox" Value="http://alpha1.vtcpay.vn/portalgateway/checkout.html"></asp:ListItem>
                            <asp:ListItem Text="Live" Value="https://vtcpay.vn/bank-gateway/checkout.html"></asp:ListItem>
                        </asp:DropDownList>
                    </td>
                </tr>

                <tr>
                    <td>Mã website
                    </td>
                    <td>
                        <asp:TextBox ID="txtWebsiteID" runat="server" Text="5023"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Giá trị đơn hàng:
                    </td>
                    <td>
                        <asp:TextBox ID="txtTotalAmount" runat="server" Text="50000"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Tài khoản nhận
                    </td>
                    <td>
                        <asp:TextBox ID="txtReceiveAccount" runat="server" Text="0963465816"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td class="style1">Đơn vị thanh toán:
                    </td>
                    <td class="style1">
                        <asp:DropDownList ID="ddlCurrency" runat="server">
                            <asp:ListItem Text="VND" Selected="True" Value="VND"></asp:ListItem>
                            <asp:ListItem Text="USD" Value="USD"></asp:ListItem>
                        </asp:DropDownList>
                    </td>
                </tr>

                <tr>
                    <td>Mã đơn hàng
                    </td>
                    <td>
                        <asp:TextBox ID="txtOrderID" runat="server"></asp:TextBox>
                    </td>
                </tr>



                <tr>
                    <td>Loại giao dịch
                    </td>
                    <td>
                        <asp:TextBox ID="txtTransactionType" ReadOnly="true" runat="server" Text="sale">
                        </asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Ngôn ngữ
                    </td>
                    <td>
                        <asp:DropDownList ID="ddlLanguage" runat="server">
                            <asp:ListItem Value="vi" Text="Viet Name"></asp:ListItem>
                            <asp:ListItem Value="en" Text="English"></asp:ListItem>
                        </asp:DropDownList>
                    </td>
                </tr>

                <tr>
                    <td>Url đón kết quả
                    </td>
                    <td>
                        <asp:TextBox ID="txtUrlReturn" runat="server"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Hình thức thanh toán
                    </td>
                    <td>
                        <asp:TextBox ID="txtPaymentType" runat="server" Text=""> 
                        </asp:TextBox>VTCPay, DomesticBank, InternationalCard
                    </td>
                </tr>
                
                <tr>
                    <td>Email khách hàng
                    </td>
                    <td>
                        <asp:TextBox ID="txtEmail" runat="server" Text="huan.khuc@vtc.vn"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Số điện thoại khách hàng:
                    </td>
                    <td>
                        <asp:TextBox ID="txtPhone" runat="server" Text="0986699480"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Địa chỉ khách hàng:
                    </td>
                    <td>
                        <asp:TextBox ID="txtAddressLine1" runat="server" Text="23 Lạc Trung"></asp:TextBox>
                    </td>
                </tr>


                <tr>
                    <td>Thành phố:
                    </td>
                    <td>
                        <asp:TextBox ID="txtCity" runat="server" Text="Hà Nội"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Họ:
                    </td>
                    <td>
                        <asp:TextBox ID="txtSurName" runat="server" Text="Khúc Chí"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Tên:
                    </td>
                    <td>
                        <asp:TextBox ID="txtForeName" runat="server" Text="Huân"></asp:TextBox>
                    </td>
                </tr>


                <tr>
                    <td></td>
                    <td>
                        <asp:Button ID="Button1" runat="server" Text="Thanh toán đơn hàng" OnClick="Button1_Click"
                            Width="188px" />
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <asp:Label ID="Label1" runat="server"></asp:Label></td>
                </tr>

            </table>
        </div>
    </form>
</body>
